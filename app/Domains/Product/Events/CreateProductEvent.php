<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateProductEvent{

    public function createProduct(Request $request){

        // Define text input variable

            // products
            $code = $this->generatorCode();
            $category = $request->input('product-category');
            $type = $request->input('product-type');

            // products_name
            $model = $request->input('name-input-model');
            $modelSerial = $request->input('name-input-model-serial');

            // products_brand
            $brand = $request->input('brand-input-brand');
            $brandCode = $request->input('brand-input-brand-code');
            $frozenCode = $request->input('brand-input-frozen-code');

            // Define image input variable
            $productCover = $request->file('product-cover');
            $productImageArray = $request->file('product-image');
            $brandCover = $request->file('brand-cover');

            // Define directory
            $disk = 'public';
            $directory = "product/$category/$code";

            // image
            $productCover = $request->file('product-cover');
            $productImage = $request->file('product-image');
            $brandCover = $request->file('brand-cover');

        /**
         * save product information
         */
        try{

            // save image
            if (!$productCover) {
                return false;
            }
            
            $originalName = $productCover->getClientOriginalName();
            $newFileName = 'cover.' . $productCover->getClientOriginalExtension();
            $path = $productCover->storeAs($directory, $newFileName, $disk);

            if ($productImage) {
                foreach($productImage as $image){
                    $originalName = $image->getClientOriginalName();
                    $path = $image->storeAs($directory, $originalName, $disk);
                }
            }

            if($brandCover){
                foreach($brandCover as $index => $cover){
                    // $originalName = $cover->getClientOriginalName();
                    // $originalExtension = $cover->getClientOriginalExtension();
                    // $originalName = $cover->getClientOriginalName();
                    $newName = 'cover.png';
                    $path = $cover->storeAs("$directory/$brandCode[$index]", $newName, $disk);
                }
            }

            // products
            $productData = [
                'product_code' => $code,
                'product_category' => $category,
                'product_type' => $type,
            ];

            Product::create($productData);

            // products_name
            $debugName = [];
            for ($i = 0; $i < count($model); $i++) {

                // filter empty input
                if(!isset($model[$i])){
                    continue;
                }

                $productNameData = [
                    'name' => $model[$i] . ' ' .$modelSerial[$i],
                    'product_code' => $code,
                ];
                
                // insert data
                // $debugName[] = $productNameData;
                DB::table('products_name')
                     ->insert($productNameData);
            }

            // products_brand
            $debugBrand = [];
            for ($i = 0; $i < count($brand); $i++) {

                // filter empty input
                if(!isset($brandCode[$i])){
                    continue;
                }

                $productBrandData = [
                    'sku_id' => $this->generatorSkuId(),
                    'brand' => $brand[$i],
                    'code' => $brandCode[$i],
                    'frozen_code' => $frozenCode[$i],
                    'product_code' => $code,
                ];
            
                // insert data
                DB::table('products_brand')
                    ->insert($productBrandData);
            }

            return redirect()->back();

        }catch(\Exception $e){
            $message = $e->getMessage();
        }

        if(isset($message)){
            dd($message);
        }

        dd($debugBrand);
        
        return redirect()->back();
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