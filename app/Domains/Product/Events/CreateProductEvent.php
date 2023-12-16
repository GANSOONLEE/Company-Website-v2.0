<?php

namespace App\Domains\Product\Events;

// Models
use App\Domains\Product\Models\Product;
use App\Models\Operation;

// Laravel Support
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CreateProductEvent{

    public $product;

    public $directory;

    public $productImages;
    public $productModel;
    public $productModelSerial;
    public $productBrandImages;
    public $productBrand;
    public $productBrandCode;
    public $productFrozenCode;
    public $productCategory;
    

    public $productCode;

    public function createProduct(Request $request){

        /**
         * blade view file => backend.admin.product.create-product-test.blade.php
         * 
         * Product Image =  product-0 ~ product-9
         * 
         * Product Model = product-model-0 ~ product-model-9
         * Product Model Serial = product-model-serial-0 ~ product-model-serial-9
         * 
         * Brand Image = brand-0 ~ brand-9
         * Brand name = product-brand-0 ~ product-brand-9
         * Brand code = product-brand-code-0 ~ product-brand-code-9
         * Brand frozen code = product-frozen-code-0 ~ product-frozen-code-9
         * 
         * Product Category = product-category
         */
   
        /* -------------------- get parameters and defined it -------------------- */

            // Product Image
            $productImages = [];
            for($i = 0; $i < 10; $i++){
                $productImages[] = $request->file("product-$i");
            }

            // Product Model
            $productModel = [];
            for($i = 0; $i < 10; $i++){
                $productModel[] = $request->input("product-model-$i");
            }

            $productModelSerial = [];
            for($i = 0; $i < 10; $i++){
                $productModelSerial[] = $request->input("product-model-serial-$i");
            }

            // Brand Image

            $productBrandImages = [];
            for($i = 0; $i < 10; $i++){
                $productBrandImages[] = $request->file("brand-$i");
            }

            $productBrand = [];
            for($i = 0; $i < 10; $i++){
                $productBrand[] = $request->input("product-brand-$i");
            }

            $productBrandCode = [];
            for($i = 0; $i < 10; $i++){
                $productBrandCode[] = $request->input("product-brand-code-$i");
            }

            $productFrozenCode = [];
            for($i = 0; $i < 10; $i++){
                $productFrozenCode[] = $request->input("product-frozen-code-$i");
            }

            // Product Category
            $productCategory = $request->input("product-category");


        /* -------------------- encapsulated parameters -------------------- */

        
        $productCode = $this->generatorCode();
        $this->productCode = $productCode;

        $this->directory = "product/$productCategory/$productCode/";

        $this->productImages = $productImages;
        $this->productModel = $productModel;
        $this->productModelSerial = $productModelSerial;
        $this->productBrandImages = $productBrandImages;
        $this->productBrand = $productBrand;
        $this->productBrandCode = $productBrandCode;
        $this->productFrozenCode = $productFrozenCode;
        $this->productCategory = $productCategory;

        // if throw error, rollback operation
        try{
            $this->createProductBase();
            $this->createImagePath();
            $this->createProductName();
            $this->createProductBrand();

            $data = [
                'status' => 'successful',
                'message' => trans('product.upload-successful'),
            ];
        }catch (\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            $this->createProductFailureRollback();

            $data = [
                'status' => 'failure',
                'message' => trans('product.upload-failure'),
            ];
        }
        
        return redirect()->back()->withCookie(cookie(
            'sessionData',
            json_encode($data),
            0.05,
            null,
            null,
            false,
            false,
            true
        ));

    }

    public function createImagePath(){

        // Global
        $disk = 'public';
        $baseDirectory = $this->directory;

        $productImages = $this->productImages;
        foreach($productImages as $index => $productImage){

            if(!isset($productImage)){
                break;
            }

            $fileExtension = $productImage->getClientOriginalExtension();

            if($index==0){
                $newFileName = "cover.$fileExtension";
            }else{
                $newFileName =
                    $this->productModel[0] . ' ' .
                    $this->productModelSerial[0] . '-' .
                    $index . ".$fileExtension";
            }

            $productImage->storeAs($baseDirectory, $newFileName, $disk);

        }
        
        $productBrandImages = $this->productBrandImages;

        $productBrand = $this->productBrand;
        $productBrandCode = $this->productBrandCode;
        $productFrozenCode = $this->productFrozenCode;
        foreach($productBrandImages as $index => $productBrandImage){

            if(
                !isset($productBrandImage)
            ){
                break;
            }

            if(
                !isset($productBrand) ||
                !isset($productBrandCode) ||
                !isset($productFrozenCode)
            ){
                break;
            }

            $fileExtension = $productBrandImage->getClientOriginalExtension();
            $newFileName = "cover.$fileExtension";

            $productBrandImage->storeAs($baseDirectory . "/$productBrandCode[$index]/", $newFileName, $disk);

        }
    }

    public function createProductBase(): void{

        $productCode = $this->productCode;
        $productCategory = $this->productCategory;

        $productBasicData = [
            'product_code' => $productCode,
            'product_category' => $productCategory,
        ];

        $product = Product::create($productBasicData);
        $this->product = $product;
    }

    public function createProductName(): void{

        $productModel = $this->productModel;
        $productModelSerial = $this->productModelSerial;

        $productNames = [];
        foreach($productModel as $index => $model){

            if(!$model || !isset($model)){
                break;
            }

            $productNames = $model . ' ' .  $productModelSerial[$index];

            $productNameData = [
                'name' => $productNames,
                'product_code' => $this->productCode,
            ];

            DB::table('products_name')
                ->insert($productNameData);
        }

    }

    public function createProductBrand(): void{

        $productBrand = $this->productBrand;
        $productBrandCode = $this->productBrandCode;
        $productFrozenCode = $this->productFrozenCode;

        foreach($productBrandCode as $index => $brand_code){

            if(
                !isset($productBrand[$index]) ||
                !isset($brand_code) ||
                !isset($productFrozenCode[$index])
            ){
                break;
            }

            $productBrandData = [
                'sku_id' => $this->generatorSkuId(),
                'brand' => $productBrand[$index],
                'code' => $brand_code,
                'frozen_code' => $productFrozenCode[$index],
                'product_code' => $this->productCode,
            ];

            DB::table('products_brand')->insert($productBrandData);
        }
    }

    public function createProductFailureRollback(): void{
        $product = $this->product;
        $product->deleteWithRelatedRecordsForce();

        $directory = $this->directory;

        // delete Image
        if(
            strpos($directory, $this->productCategory) &&
            strpos($directory, $this->productCode)
        ){
            Storage::disk('public')->deleteDirectory($directory);
        }

        Log::error("The Product $this->productCode has be deleted");

    }

    public function generatorCode(): string{
        $code = Str::random(12);
        $checkDuplicationCode = Product::where('product_code', $code)->first();
        if($checkDuplicationCode){
            $this->generatorCode();
        }
        return $code;
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
}