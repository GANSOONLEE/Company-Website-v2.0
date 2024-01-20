<?php

namespace App\Domains\Product\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Domains\Product\Events\ProductCreated;
use App\Domains\Product\Events\ProductUpdated;
use App\Domains\Product\Events\ProductDeleted;
use App\Domains\Product\Events\ProductRestored;
use App\Domains\Product\Events\ProductDestroyed;

use App\Domains\Product\Services;

class ProductService extends BaseService
{

    public $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Product Code Generator
     * 
     * @return string
     */
    public function generateProductCode(): string
    {
        $code = Str::random(12);
        $checkDuplicationCode = Product::where('product_code', $code)->first();
        return $checkDuplicationCode ?
            $this->generateProductCode() :
            $code;
    }

    /**
     * Brand Sku ID Generator
     * 
     * @return string
     */
    public function generatorBrandSkuId(): string
    {
        $skuID = Str::random(8);
        $checkDuplicationSkuID = DB::table('products_brand')->where('sku_id', $skuID)->exists();
        return $checkDuplicationSkuID ?
            $this->generatorBrandSkuId() :
            $skuID ;
    }

    /**
     * @param Product $product
     * 
     * @return mixed
     */
    public function registerProduct(array $data = []): Product
    {

        DB::beginTransaction();

        try{
            $product = $this->createProduct($data);
        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your product.'));
        }

        event(new ProductCreated($product));

        DB::commit();
        return $product;

    }

    /**
     * @param array $data
     * 
     * @return Product
     * @throws GeneralException
     */
    public function store(array $data = []): Product
    {
        DB::beginTransaction();

        try{

            // Get Unique Product Code
            $product_code = $this->generateProductCode();

            // Create Product Basic Information
            $product = $this->createProduct([
                'product_code' => $product_code,
                'product_category' => $data['product_category'] ?? null,
                'product_status' => $data['product_status'] ?? null,
                'remarks' => $data['remark'] ?? null,
            ]);

            // Create Product Name Information
            $name = $this->createProductName(
                $data['model'],
                $data['model-serial'],
                $product_code
            );

            // Create Product Brand Information
            $skuIDs = $this->createProductBrand(
                $data['brand'],
                $data['brand-code'],
                $data['frozen-code'],
                $product_code
            );

            // Save Image
            $this->saveImage(
                $data['product-image'],
                $data['brand-image'],
                $name,
                $skuIDs,
                $data['product_category'],
                $product_code
            );

        }catch(Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your problem\. Please try again.'));
        }

        DB::commit();
        return $product;
    }
    
    public function createProduct(array $data = []): Product
    {
        return $this->model::create([
            'product_code' => $data['product_code'],
            'product_category' => $data['product_category'] ?? null,
            'product_status' => $data['product_status'] ?? 'public',
        ]);
    }

    /**
     * Create Product Name Information
     * 
     * @param array $model
     * @param array $modelSerial
     * @param string $product_code
     * 
     * @return array
     */
    public function createProductName(array $model, array $modelSerial, string $product_code): array
    {
        DB::beginTransaction();

        $name = [];
        
        try{

            // Valid are model and modelSerial length equal
            $count = count($model) ;

            // Build Name Information
            for($index = 0; $index < $count; $index++)
            {

                $fullname = path_encode(($model[$index] ?? '') . ' ' . $modelSerial[$index]);

                // $fullname = path_encode($model[$index] . ' ' . $modelSerial[$index]);

                DB::table('products_name')->insert([
                    'product_code' => $product_code,
                    'name' => $fullname
                ]);

                $name[] = $fullname;
            }
            
        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
            throw new GeneralException(__('There was a problem creating your product.'));
        }
        
        DB::commit();
        return $name;
    }


    /**
     * Create Product Brand Information
     * 
     * @param array $brand
     * @param array $brand_code
     * @param array $frozen_code
     * @param string $product_code
     * 
     * @return array $skuIDs
     */
    public function createProductBrand(array $brand, array $brand_code, array $frozen_code, string $product_code): array
    {
        $skuIDs = [];

        DB::beginTransaction();

        try{

            $count = count($brand) !== count($brand_code) ?
                throw new GeneralException('Model and modelSerial lengths must equal') :
                count($brand);

        
            // Build Brand Information
            for($index = 0; $index < $count; $index++)
            {
                $skuID = $this->generatorBrandSkuId();
                $frozen_code_element = $frozen_code[$index] ?? null;

                DB::table('products_brand')->insert([
                    'product_code' => $product_code,
                    'sku_id' => $skuID,
                    'brand' => path_encode($brand[$index]),
                    'code' => path_encode($brand_code[$index]),
                    'frozen_code' => path_encode($frozen_code_element),
                ]);
                
                $skuIDs[] = $skuID;
            }

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            throw new GeneralException(__('There was a problem creating your product.'));
        }
        
        DB::commit();
        return $skuIDs;
    }

    /**
     * Save Image
     * @param array $product_image
     * @param array $brand_image
     * @param array $skuIDs
     * @param string $product_code
     * 
     * @return mixed
     */
    public function saveImage(array $product_image, array $brand_image,array $name, array $skuIDs ,string $product_category ,string $product_code): mixed
    {
        DB::beginTransaction();

        $imagePath = [];
        $productImagePath = [];
        $brandImagePath = [];

        try{

            // init parameters
            $disk = 'public';
            $baseDirectory = "product/$product_category/$product_code";

            if(Product::where('product_code', $product_code)->first()->product_category !== $product_category){
                $files = Storage::disk('public')->allFiles($baseDirectory);

                // 移动所有文件到目标文件夹
                foreach ($files as $file) {
                    // 获取相对路径
                    $relativePath = str_replace("product/$product_category/", '', $file);
    
                    // 构建目标文件的路径
                    $destinationFile = "product/$product_category/" . $relativePath;
    
                    // 移动文件
                    Storage::disk('public')->move($file, $destinationFile);
                }
    
                // 删除源文件夹
                Storage::disk('public')->deleteDirectory("product/$product_category/$product_code");
            }

            /* ---------------- Product Image ---------------- */

            //define Product Image Name
            if(count($product_image) > 0){
                foreach($product_image as $index => $image){
    
                    if(!$image){
                        break;
                    }
    
                    $fileExtension = $image->getClientOriginalExtension();
    
                    $newFileName = ($index === 0)
                        ? "cover.$fileExtension"
                        : "cover-$index.$fileExtension";
    
                    $productImagePath[] = $image->storeAs($baseDirectory, $newFileName, $disk);
                }
            }

            /* ---------------- Product Image ---------------- */

            //define Brand Image Name
            if(count($brand_image) > 0){
                foreach($brand_image as $index => $image){

                    if(!$image){
                        break;
                    }

                    $fileExtension = $image->getClientOriginalExtension();

                    $newFileName = "cover.$fileExtension";
                    
                    $skuIDs[$index] ?? throw new GeneralException('There has problem to saving your image.');

                    $brandImagePath[] = $image->storeAs($baseDirectory . "/$skuIDs[$index]", $newFileName, $disk);
                }
            }

            $imagePath = [
                'product' => $productImagePath,
                'brand' => $brandImagePath,
            ];

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage(), $e->getLine(), $e->getFile());
            throw new GeneralException(__('There was a problem creating your product.'));
        }

        DB::commit();
        return $imagePath;
    }

    /**
     * @param string $id
     * @param array $data
     * 
     * @return Product
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(string $id, array $data = []): Product
    {
        DB::beginTransaction();

        $name = [];
        $skuIDs = [];

        try{

            // Get product instance
            $product = Product::where('id', $id)->first();


            // Create Product Name Information
            $name = $this->updateProductName($product, [
                'model' => $data['model'],
                'model_serial' => $data['model-serial'],
            ]);

            // Create Product Brand Information
            $skuIDs = $this->updateProductBrand($product, [
                'brand' => $data['brand'],
                'brand_code' => $data['brand-code'],
                'frozen_code' => $data['frozen-code'],
            ]);

            // Create Product Basic Information
            $this->updateProduct($product, [
                'product_category' => $data['product_category'] ?? null,
                'product_status' => $data['product_status'] ?? null,
                'remarks' => $data['remark'] ?? null,
            ]);

        }catch(Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your problem\. Please try again.'));
        }

        DB::commit();

        // Save Image
        $this->saveImage(
            $data['product-image'] ?? [],
            $data['brand-image'] ?? [],
            $name,
            $skuIDs,
            $data['product_category'],
            $product->product_code
        );


        return $product;
    }

    /**
     * @param Product $product
     * @param array $data
     * 
     * @return void
     */
    public function updateProduct(Product $product, array $data = []) :void
    {
        // update product 更新產品

        $originCategory = $product->product_category;

        $product->update([
            'product_category' => $data['product_category'] ?? null,
            'product_status' => $data['product_status'] ?? null,
            'remarks' => $data['remarks'] ?? null,
        ]);

        // move image path
        $originPath = "product/$originCategory/$product->product_code";
        $newPath = "product/" . $data['product_category'] . "/$product->product_code";
        Storage::disk('public')->move($originPath, $newPath);

    }

    /**
     * @param Product $product
     * @param array $data
     * 
     * @return mixed
     */
    public function updateProductName(Product $product, array $data = []) :mixed
    {
        $fullName = [];
        // Origin Record 原本的記錄
        $originName = $product->names()->pluck('name')->toArray();

        // Fullname 組裝記錄
        foreach ($data['model'] as $key => $model){
            $fullName[] = ($model ?? '') . ' ' . $data['model_serial'][$key];
        }
        // Deleted Record 找出已經被刪除的記錄
        $deletedName = array_diff($originName, $fullName);
        foreach ($deletedName as $name){
            DB::table('products_name')
                ->where('product_code', $product->product_code)
                ->where('name', $name)
                ->delete();
        }

        // Find New Record 找出新增加的記錄
        $newName = array_diff($fullName, $originName);
        foreach ($newName as $name){
            DB::table('products_name')->insert([
                'name' => $name,
                'product_code' => $product->product_code,
            ]);
        }

        return array_merge($product->names()->pluck('name')->toArray());
    }

    /**
     * @param Product $product
     * @param array $data
     * 
     * @return mixed
     */
    public function updateProductBrand(Product $product, array $data=[]) :mixed
    {
        $sku_ids = [];
        $brands = [];
        $brand_codes = [];
        $frozen_codes = [];

        // Origin Record 原本的記錄
        $originSkuId = $product->brands()->pluck('sku_id')->toArray();
        $originBrand = $product->brands()->pluck('brand')->toArray();
        $originCode = $product->brands()->pluck('code')->toArray();
        $originFrozenCode = $product->brands()->pluck('frozen_code')->toArray();

        // Fullname 組裝記錄
        foreach ($data['brand_code'] as $key => $code){
            $brands[$key] = $data['brand'][$key];
            $brand_codes[$key] = $code;
            $frozen_codes[$key] = $data['frozen_code'][$key];

            $sku_ids[] = $product->brands()->where('brand', $brands[$key])->first()->sku_id ?? null;
        }

        // dd(
        //     $sku_ids, 
        //     array_diff($originSkuId, $sku_ids), # 要刪除的記錄
        //     array_diff($sku_ids, $originSkuId), # 要新增的記錄
        //     $originSkuId # 原本的記錄
        // );

        foreach ($sku_ids as $index => $skuId){
            DB::table('products_brand')
                ->where('product_code', $product->product_code)
                ->where('sku_id', $skuId)
                ->update([
                    "code" => $brand_codes[$index],
                    "frozen_code" => $frozen_codes[$index],
                ]);
        }

        // Deleted Record 找出要被刪除的記錄
        $deletedSkuId = array_diff($originSkuId, $sku_ids);
        foreach ($deletedSkuId as $skuId){
            DB::table('products_brand')
                ->where('product_code', $product->product_code)
                ->where('sku_id', $skuId)
                ->delete();
        }

        // Find New Record 找出要新增加的記錄
        $newSkuId = array_diff($sku_ids, $originSkuId);
        foreach ($newSkuId as $number => $skuId){
            DB::table('products_brand')->insert([
                'brand' => $brands[$number],
                'code' => $brand_codes[$number],
                'frozen_code' => $frozen_codes[$number],
                'sku_id' => $this->generatorBrandSkuId(),
                'product_code' => $product->product_code,
            ]);
        }

        return array_merge($product->brands()->pluck('sku_id')->toArray());
    }

    /**
     * Search product at global
     * @param string $searchTerm
     * 
     * @return mixed
     */
    public function search(string $searchTerm): mixed
    {
        return Product::select('products.*', 'products_name.name')
            ->addSelect(DB::raw('GROUP_CONCAT(DISTINCT products_name.name) as names'))
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->leftJoin('products_brand', 'products_brand.product_code', '=', 'products.product_code')
            ->where(function ($query) use ($searchTerm) {
                $query->where('products_name.name', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.brand', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.code', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.frozen_code', 'like', "%$searchTerm%")
                    ->orWhere('products.product_category', 'like', "%$searchTerm%");
            })
            ->orderBy('products_name.name')
            ->groupBy('products.id', 'products.product_code')
            ->paginate(10)
            ->withQueryString();
    }
}