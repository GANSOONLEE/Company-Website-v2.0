<?php

namespace App\Domains\Product\Events;
use App\Domains\Product\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UpdateProductEventOld{

    public $mode = "production"; // debug production
    public $disk = "public";
    public $product_code;
    public $product;


    public $sourceCategory;
    public $sourceType;
    public $sourceDirectory;


    public $destinationCategory;
    public $destinationType;
    public $destinationDirectory;

    public function updateProduct(Request $request, $product_code){

        // if(auth()->user()->email == "vincentgan0402@gmail.com"){
        //     $this->mode = "debug"; 
        // }

        $this->product_code = $product_code;

        // Get product instance
        $product = Product::where('product_code', $product_code)->first();
        $this->product = $product;

        // Set source attributes
        $this->sourceCategory = $product->product_category;
        $this->sourceType = $product->product_type;
        $this->sourceDirectory = "product/$this->sourceCategory/$this->product_code";

        // Set destination attributes
        $this->destinationCategory = $request->category;
        $this->destinationType = $request->type;
        $this->destinationDirectory = "product/$this->destinationCategory/$this->product_code";

        // dd(
        //     $this->mode,
        //     $this->disk,
        //     $this->product_code,
        //     $this->product,
        //     $this->sourceCategory,
        //     $this->sourceType,
        //     $this->sourceDirectory,
        //     $this->destinationCategory,
        //     $this->destinationType,
        //     $this->destinationDirectory,
        // );

        // Update Data
    

            $this->productUpdate();

            $destinationNameArray = $request->fullname;
            $this->productNameUpdate($destinationNameArray);

            $destinationBrandArray = $request->brand;
            $destinationBrandCodeArray = $request->input('brand-code');
            $destinationFrozenCodeArray = $request->input('frozen-code');

            $this->productBrandUpdate(
                $destinationBrandArray,
                $destinationBrandCodeArray,
                $destinationFrozenCodeArray,
            );
                

        /*
            | Operation record 记录操作
            | 
        */
            
        $operationData = [
            'email' => auth()->user()->email,
            'operation_type' => 'Update',
            'operation_category' => 'Product',
        ];

        // Get image entities

        /**
         * Update Image
         */
        
        $product_cover = $request->file("product-cover");
        isset($product_cover) ? $this->productCoverUpdate($product_cover) : '';


        $productImageCollection = [];
        for($i = 0; $i < 10; $i++){
            if($request->file("product-image-" . $i)){
                $productImageCollection[$i] = $request->file("product-image-" . $i);
            }
        }
        $productImageCollection > 0 ? $this->productImageUpdate($productImageCollection) : '';

        
        $brandCoverCollection = [];
        for($i = 0; $i < 10; $i++){
            if($request->file("brand-image-" . $i)){
                $brandCoverCollection[$i] = $request->file("brand-image-" . $i);
            }
        }

        $brandCoverCollection > 0 ? $this->brandCoverUpdate($brandCoverCollection, $destinationBrandCodeArray) : '';

        if($this->mode == 'debug'){
            dd(
                $product_cover,
                $productImageCollection,
                $brandCoverCollection,
            );
        }

        /**
         * Change Image Path
         */
        $this->changeImagePath($this->sourceCategory, $this->destinationCategory);

        $this->mode === "production" ? Operation::create($operationData) : dd('debug');

        return redirect()->route('backend.admin.product.edit-product-more', ['productCode' => $product_code]);
    }


    /**
     * @method Update product cover
     * @param object $product_cover
     * @return void
     */

    public function productCoverUpdate(object $product_cover): void{

        // product cover exists
        if(!$product_cover){
            return;
        }

        $newFileName = 'cover.' . $product_cover->getClientOriginalExtension();
        $this->mode === "production" ? $product_cover->storeAs($this->sourceDirectory, $newFileName, $this->disk) : var_dump($product_cover);

        // dd($product_cover->storeAs($this->sourceDirectory, $newFileName, $this->disk));

    }


    /**
     * @method Update product image
     * @param array $productImageCollect
     * @return void
     */

    public function productImageUpdate(array $productImageCollection): void{

        // product cover exists
        if(!$productImageCollection > 0){
            return;
        }

        foreach($productImageCollection as $productImage){

            $originalFileName = $productImage->getClientOriginalName();
            $newFileName = str_replace('/', '_', $originalFileName);
            $path = $this->sourceDirectory . '/' . $originalFileName;

            // Check exists
            if(Storage::disk($this->disk)->exists($path)){
                continue;
            }

            $this->mode === "production" ? $productImage->storeAs($this->sourceDirectory, $newFileName, $this->disk) : var_dump($productImageCollection);
        }


    }

    /**
     * @method Update brand cover
     * @param array $brandCoverCollect
     * @return void
     */

    public function brandCoverUpdate(array $brandCoverCollection, array $destinationBrandCodeArray): void{

        // product cover exists
        if($brandCoverCollection < 0){
            return;
        }

        $debug = [];
        
        foreach($brandCoverCollection as $index => $brandCover){

            // dd($destinationBrandCodeArray, $brandCoverCollection);

            $extension = $brandCover->getClientOriginalExtension();
            $originalFileName = $brandCover->getClientOriginalName();
            $newFileName = "cover." . $extension;
            $path = $this->sourceDirectory . '/' . $destinationBrandCodeArray[$index];

            // $debug[] = [
            //     'index' => $index,
            //     'brand_code' => $destinationBrandCodeArray[$index],
            //     'originalFileName' => $originalFileName,
            //     'path' => $path,
            //     'newFileName' => $newFileName,
            // ];

            // dd($debug[]);

            $this->mode === "production" ? $brandCover->storeAs($path, $newFileName, $this->disk) : var_dump($brandCoverCollection);
                 
        }

        // dd($brandCoverCollection, $debug, $destinationBrandCodeArray);

    }

    
    public function generatorSkuId(): string{
        $skuID = Str::random(8);
        $checkDuplicationSkuID = DB::table('products_brand')
            ->where('sku_id', $skuID)
            ->exists();
        if($checkDuplicationSkuID){
            $this->generatorSkuId();
        }
        return $skuID;
    }


    public function productUpdate(){

        $productData = [
            'product_category' => $this->destinationCategory,
            'product_type' => $this->destinationType,
            'updated_at' => now(),
        ];

        $this->mode === "production" ? $this->product->update($productData) : var_dump($productData);

    }


    public function productNameUpdate(array $destinationNameArray): void{

        // Get records collection
        $sourceNameRecords = DB::table('products_name')
                    ->where('product_code', $this->product_code)
                    ->get();
        
        // Decode with Array
        $sourceNameArray = [];
        foreach($sourceNameRecords as $record){
            $sourceNameArray[] = $record->name;
        }

        // Get deleted records array
        $deletedRecords = array_diff($sourceNameArray, $destinationNameArray);

        if(count($deletedRecords) > 0){
            foreach($deletedRecords as $recordName){   
                $this->mode === "production" ? DB::table('products_name')->where('name', $recordName)->delete() : var_dump($recordName);
            }
        }

        if(count($destinationNameArray) > 0){

            foreach($destinationNameArray as $recordName){

                // check exists
                $isRecordExists = DB::table('products_name')
                                    ->where('product_code', $this->product_code)
                                    ->where('name', $recordName)
                                    ->exists();

                if($isRecordExists || $recordName == null){
                    continue;
                }

                $productNameData = [
                    'name'=> $recordName,
                    'product_code' => $this->product_code,
                ];

                $this->mode === "production" ? DB::table('products_name')->insert($productNameData) : var_dump($productNameData);

            }

        }

    }


    public function productBrandUpdate(array $destinationBrandArray, array $destinationBrandCodeArray, array $destinationFrozenCodeArray): void{

        $sourceBrandCodeRecord = DB::table('products_brand')
                    ->where('product_code', $this->product_code)
                    ->get('code');

        $sourceBrandCodeArray = [];
        foreach($sourceBrandCodeRecord as $record){
            $sourceBrandCodeArray[] = $record->code;
        }

        $deletedRecords = array_diff($sourceBrandCodeArray, $destinationBrandCodeArray);

        if(count($deletedRecords) > 0){
            foreach($deletedRecords as $index => $recordCode){
                if($this->mode === "production"){
                    DB::table('products_brand')
                        ->where('product_code', $this->product_code)
                        ->where('code', $recordCode)
                        ->update([
                            'code' => $destinationBrandCodeArray[$index],
                            'frozen_code' => $destinationBrandCodeArray[$index],
                        ]);

                        $disk = 'public';
                        $oldFolderPath = "product/$this->sourceCategory/$this->product_code/$sourceBrandCodeArray[$index]";
                        $newFolderPath = "product/$this->destinationCategory/$this->product_code/$destinationBrandCodeArray[$index]";
                        
                        // 更改文件夾名稱
                        Storage::disk($disk)->move($oldFolderPath, $newFolderPath);
                }else{
                    var_dump($recordCode);
                }
            }
        }

        foreach($destinationBrandArray as $index => $recordBrand){

            // check exists
            $isRecordExists = DB::table('products_brand')
                ->where('product_code', $this->product_code)
                ->where('code', $destinationBrandCodeArray[$index])
                ->exists();
            
            if($isRecordExists){
                continue;
            }

            if(!$destinationBrandCodeArray[$index]){
                continue;
            }

            $productBrandData = [
                'sku_id' => $this->generatorSkuId(),
                'brand' => $recordBrand,
                'code' => $destinationBrandCodeArray[$index],
                'frozen_code' => 'FZ-' . $destinationFrozenCodeArray[$index],
                'product_code' => $this->product_code,
            ];

            $this->mode === "production" ? DB::table("products_brand")->insert($productBrandData) : var_dump($productBrandData);

        }

    }


    /**
     * @method change the image path
     * @param string $category
     * @return void
     */

    public function changeImagePath(string $sourceCategory, string $destinationCategory): void{

        $sourceDirectory = "product/$sourceCategory/$this->product_code";
        $destinationDirectory = "product/$destinationCategory/$this->product_code";

        // check folder exists
        if(!Storage::disk($this->disk)->exists($sourceDirectory)){
            return;
        }

        $sourcePath = Storage::disk($this->disk)->path($sourceDirectory);
        $destinationPath = Storage::disk($this->disk)->path($destinationDirectory);

        if($this->mode === "production" ? File::moveDirectory($sourcePath, $destinationPath) : var_dump($sourcePath, $destinationPath));
        
    }


}