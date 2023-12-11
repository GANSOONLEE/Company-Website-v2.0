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

class UpdateProductEvent{

    // Product Instance
    public $product;

    // Global Attribute Properties
    public $directory;

    // Original Attribute Properties
    public $currentProductImages;
    public $currentProductModel;
    public $currentProductModelSerial;
    public $currentProductBrandImages;
    public $currentProductBrand;
    public $currentProductBrandCode;
    public $currentProductFrozenCode;
    public $currentProductCategory;

    // Update Attribute Properties
    public $productImages;
    public $productModel;
    public $productModelSerial;
    public $productBrandImages;
    public $productBrand;
    public $productBrandCode;
    public $productFrozenCode;
    public $productCategory;
    

    public $productCode;

    public function updateProduct(Request $request, $productCode){

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

        $this->productCode = $productCode;

        $this->directory = "product/$productCategory/$productCode";
        $this->product = Product::where('product_code', $this->productCode)->first();
        $this->currentProductCategory = $this->product->product_category;

        // Update Attribute Properties
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
            $this->updateImagePath();
            $this->updateProductBase();
            $this->updateProductName();
            $this->updateProductBrand();

            $data = [
                'status' => 'successful',
                'message' => trans('product.update-successful'),
            ];
        }catch (\Exception $e){
            $this->updateProductFailureRollback();
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());

            dd($e->getMessage(), $e->getLine(), $e->getFile());

            $data = [
                'status' => 'failure',
                'message' => trans('product.update-failure'),
            ];
        };

        Operation::create([
            'email' => auth()->user()->email,
            'operation_type' => 'Update',
            'operation_category' => 'Product'
        ]);
        
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

    public function updateImagePath(){

        // Global
        $disk = 'public';
        $baseDirectory = $this->directory;
        $productImages = $this->productImages;

        // check have change category
        if($this->currentProductCategory != $this->productCategory){
            $this->directory = "product/$this->currentProductCategory/$this->productCode";

            Storage::disk($disk)->move($this->currentProductCategory, $baseDirectory);
        }

        foreach($productImages as $index => $productImage){

            if(!isset($productImage)){
                continue;
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

            $productImage->storeAs($baseDirectory, file_path_encode($newFileName), $disk);
        }
        
        $productBrandImages = $this->productBrandImages;

        $productBrand = $this->productBrand;
        $productBrandCode = $this->productBrandCode;
        $productFrozenCode = $this->productFrozenCode;
        
        foreach($productBrandImages as $index => $productBrandImage){

            if(
                !isset($productBrandImage)
            ){
                continue;
            }

            if(
                !isset($productBrand) ||
                !isset($productBrandCode) ||
                !isset($productFrozenCode)
            ){
                continue;
            }

            $fileExtension = $productBrandImage->getClientOriginalExtension();
            $newFileName = "cover.$fileExtension";

            $path = $productBrandImage->storeAs($baseDirectory . "/" . file_path_encode($productBrandCode[$index]), $newFileName, $disk);
        }
    }

    public function updateProductBase(): void{

        $productCode = $this->productCode;
        $productCategory = $this->productCategory;
        $product = Product::where('product_code', $productCode)->first();

        $productBasicData = [
            'product_category' => $productCategory,
            'updated_at' => now(),
        ];

        $product->update($productBasicData);
        
    }

    public function updateProductName(): void{

        $productModel = $this->productModel;
        $productModelSerial = $this->productModelSerial;

        $productModel = array_filter($productModel);
        $productModelSerial = array_filter($productModelSerial);

        $productFullNameArray = [];
        foreach($productModel as $index => $model){
            $productFullNameArray[] = $model. " ". $productModelSerial[$index];
        }
        
        $productNameArray = [];
        $currentProductName = $this->product->getProductName();
        foreach ($currentProductName as $index => $productName) {

            $modelData = \App\Models\CarModel::all();
            $matchedModel = '';
            foreach ($modelData as $model) {
                if (stripos($productName->name, $model->name) !== false) {
                    $matchedModel = $model->name;
                    break;
                }
            }

            $serial = trim(str_ireplace($matchedModel, '', $productName->name));

            $productNameArray[] = (object)[
                'model' => $matchedModel,
                'serial' => $serial,
            ];
        }

        $sourceProductName = [];
        // arraying product brand code
        foreach($productFullNameArray as $name){
            $sourceProductName[] = $name;
        }

        $currentProductNameCode = [];
        // arraying product brand code
        foreach($currentProductName as $name){
            $currentProductNameCode[] = $name->name;
        }

        // diff at current and new 
        $differenceArray = array_diff($currentProductNameCode, $sourceProductName);

        $sourcesDifferenceArray = array_diff($sourceProductName, $currentProductNameCode);

        // if(auth()->user()->email == "vincentgan0402@gmail.com"){
            // dd(
            //     $differenceArray, // 要刪除的數據
            //     $sourcesDifferenceArray, // 要新增的數據
            //     $sourceProductName, // 最終數據
            //     $currentProductNameCode, // 原本數據
            // );
        // }
        
        if(count($differenceArray) > 0){

            foreach($differenceArray as $name){
                DB::table('products_name')
                    ->where('product_code', $this->productCode)
                    ->where('name', $name)
                    ->delete();

                Log::info("$name 被刪除了");
            }


        }



        foreach($sourcesDifferenceArray as $index => $productName){

            // check are existent record
            $productFullName = $productName;

            $productNameData = [
                'name' => $productFullName,
                'product_code' => $this->productCode,
            ];

            DB::table('products_name')
                ->insert($productNameData);
        }


    }

    public function updateProductBrand(): void{

        $productBrand = $this->productBrand;
        $productBrandCode = $this->productBrandCode;
        $productFrozenCode = $this->productFrozenCode;

        $productBrand = array_filter($productBrand);
        $productBrandCode = array_filter($productBrandCode);
        $productFrozenCode = array_filter($productFrozenCode);

        $currentProductBrand = $this->product->getProductBrand();

        $sourceProductBrandCode = [];
        // arraying product brand code
        foreach($productBrandCode as $index => $code){
            
            if(
                !isset($productBrand[$index]) &&
                !isset($productBrandCode[$index]) &&
                !isset($productFrozenCode[$index])
            ){
                continue;
            }

            $sourceProductBrandCode[$code] = (object)[ 
                "brand" => $productBrand[$index],
                "code" => $code,
                "frozen_code" => $productFrozenCode[$index],
            ];
        }

        $currentProductBrandCode = [];
        // arraying product brand code
        foreach($currentProductBrand as $code){
            $currentProductBrandCode[] = $code->code;
        }

        // diff at current and new 
        $differenceArray = array_diff($currentProductBrandCode, array_column($sourceProductBrandCode, 'code'));

        // diff at new and current
        $updateDifferenceArray = array_diff(array_column($sourceProductBrandCode, 'code'), $currentProductBrandCode);

        if(count($differenceArray) > 0){
            
            foreach($differenceArray as $code){

                $path = DB::table('products_brand')
                    ->where('product_code', $this->productCode)
                    ->where('code', $code)
                    ->delete();

                $fileDirectory = "product/$this->productCategory/$this->productCode/$code";

                Storage::disk('public')->deleteDirectory($fileDirectory);

                Log::info("$code 被刪除了");

            }
            
        }

        if(count($updateDifferenceArray) > 0){

            foreach($updateDifferenceArray as $code){

                $checkExists = DB::table('products_brand')
                                ->where('product_code', $this->productCode)
                                ->where('code', $code)
                                ->exists();

                if($checkExists){
                    continue;
                }

                $productBrandData = [
                    'sku_id' => $this->generatorSkuId(),
                    'brand' => $sourceProductBrandCode[$code]->brand,
                    'code' => $sourceProductBrandCode[$code]->code,
                    'frozen_code' => "FZ-" . $sourceProductBrandCode[$code]->frozen_code,
                    'product_code' => $this->productCode,
                ];
            
                DB::table('products_brand')->insert($productBrandData);
            }
            
        }
        
    }

    public function updateProductFailureRollback(): void{
        $product = $this->product;

        $directory = $this->directory;

        // delete Image
        // if(
        //     strpos($directory, $this->productCategory) &&
        //     strpos($directory, $this->productCode)
        // ){
        //     $result = Storage::disk('public')->deleteDirectory($directory);
        // }

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