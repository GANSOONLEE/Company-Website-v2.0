<?php

namespace App\Domains\Product\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

            /* ---------------- Product Image ---------------- */

            //define Product Image Name
            foreach($product_image as $index => $image){

                if(!$image){
                    break;
                }

                $fileExtension = $image->getClientOriginalExtension();

                $newFileName = ($index === 0)
                    ? "cover.$fileExtension"
                    : "$name[0]-$index.$fileExtension";

                $productImagePath[] = $image->storeAs($baseDirectory, $newFileName, $disk);
            }

            /* ---------------- Product Image ---------------- */

            //define Brand Image Name
            foreach($brand_image as $index => $image){

                if(!$image){
                    break;
                }

                $fileExtension = $image->getClientOriginalExtension();

                $newFileName = "cover.$fileExtension";
                
                $skuIDs[$index] ?? throw new GeneralException('There has problem to saving your image.');

                $brandImagePath[] = $image->storeAs($baseDirectory . "/$skuIDs[$index]", $newFileName, $disk);
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
}