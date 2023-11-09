<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProductEvent{

    public $mode = "production"; // debug production
    public function updateProduct(Request $request, $product_code){

        // if(auth()->user()->email == "vincentgan0402@gmail.com"){
        //     $this->mode = "debug"; 
        // }
    
        // Define variable

            /*
             | Image 照片 
             | 
            */

            // Image (File)
            $product_cover = $request->file("product-cover");

            $product_image_collection = [];
            for($i = 0; $i < 10; $i++){
                if($request->file("product-image-" . $i)){
                    $product_image_collection[$i] = $request->file("product-image-" . $i);
                }
            }

            $brand_image_collection = [];
            for($i = 0; $i < 10; $i++){
                if($request->file("brand-image-" . $i)){
                    $brand_image_collection[$i] = $request->file("brand-image-" . $i);
                }
            }

            // Product Attributes

            /*
             | Product 商品
             | 
            */

            $category = $request->category;
            $type = $request->type;

            // Product Name
            $product_name_collection = $request->fullname;

            // Product Brand
            $product_brand_collection = $request->brand;
            $product_brand_code_collection = $request->input('brand-code');
            $product_frozen_code_collection = $request->input('frozen-code');

        /*
         | upload Image 上传照片
         | 
        */

        $disk = 'public';
        $directory = "product/$category/$product_code";

            /*
            | upload Product Cover 上传封面照
            | 
            */

            if(isset($product_cover)){
                $originalName = $product_cover->getClientOriginalName();
                $newFileName = 'cover.' . $product_cover->getClientOriginalExtension();
                $path = $product_cover->storeAs($directory, $newFileName, $disk);
            }

            /*
            | upload Product Image 上传商品照
            | 
            */

            if(count($product_image_collection) > 0){

                foreach($product_image_collection as $productImage){

                    // Delete

                    $originalName = $productImage->getClientOriginalName();
                    $modifierName = str_replace('/', '_', $originalName);
                    $path = $directory . '/' . $modifierName;

                    // Check existent
                    if(Storage::disk($disk)->exists($path)){
                        continue;
                    }

                    $this->mode === "production" ? $productImage->storeAs($directory, $modifierName, $disk) : '';
                }

            }

            

            
            /*
            | upload Brand Image 上传品牌照
            | 
            */

            if(count($brand_image_collection) >= 0){

                foreach($brand_image_collection as $key => $brandtImage){

                    $brandCode = $product_brand_code_collection[$key];

                    $originalName = $brandtImage->getClientOriginalName();
                    $originalExtension = $brandtImage->getClientOriginalExtension();
                    $modifierName = 'cover.' . $originalExtension;
                    $path = $directory . '/' . $brandCode;

                    $this->mode === "production" ? $brandtImage->storeAs($path, $modifierName, $disk) : '';
                }

            }

        // Update Data
        
            $product = Product::where('product_code', $product_code)->first();

            // products [Table]

                $productData = [
                    'product_category' => $category,
                    'product_type' => $type,
                    'updated_at' => now(),
                ];

                $this->mode === "production" ? $product->update($productData) : '';

            // products_name [Table]

                $oldNameRecord = DB::table('products_name')
                    ->where('product_code', $product_code)
                    ->get();

                $oldRecordCollection = [];
                foreach($oldNameRecord as $record){
                    $oldRecordCollection[] = $record->name;
                }

                $deleteRecord = [];
                $deleteRecord = array_diff($oldRecordCollection, $product_name_collection);

                // Check deleted record
                foreach($deleteRecord as $record){   
                    if($this->mode === "production"){
                        DB::table('products_name')
                            ->where('name', $record)
                            ->delete();
                    }
                }

                foreach($product_name_collection as $name){

                    // Check existent
                    $existentCheck = DB::table('products_name')
                                            ->where('product_code', $product_code)
                                            ->where('name', $name)
                                            ->exists();

                    if($existentCheck){
                        continue;
                    }

                    if($name == null){
                        continue;
                    }

                    $productNameData = [
                        'name' => $name,
                        'product_code' => $product_code,
                    ];

                    $this->mode === "production" ? DB::table('products_name')->insert($productNameData) : '';
                }

            // products_brand [Table]

                $oldBrandCodeRecord = DB::table('products_brand')
                    ->where('product_code', $product_code)
                    ->get('code');

                $oldRecordCollection = [];
                foreach($oldBrandCodeRecord as $record){
                    $oldRecordCollection[] = $record->code;
                }

                $deleteRecord = [];
                $deleteRecord = array_diff($oldRecordCollection, $product_brand_code_collection);
                $newRecord = array_diff($product_brand_code_collection, $oldRecordCollection);

                // Check deleted record
                foreach($deleteRecord as $index => $record){   
                    if($this->mode === "production"){
                        DB::table('products_brand')
                            ->where('product_code', $product_code)
                            ->where('code', $record)
                            ->delete();
                    }
                    if($this->mode === "production"){
                        $oldFile = Storage::disk($disk)->move("$directory/$record/cover.png", "$directory/$newRecord[$index]/cover.png");
                    }
                }

                foreach($product_brand_collection as $index => $brand){

                    // Check existent
                    $existentCheck = DB::table('products_brand')
                    ->where('product_code', $product_code)
                        ->where('code', $product_brand_code_collection[$index])
                        ->exists();

                    if($existentCheck){
                        continue;
                    }

                    $productBrandData = [
                        'sku_id' => $this->generatorSkuId(),
                        'brand' => $brand,
                        'code' => $product_brand_code_collection[$index],
                        'frozen_code' => $product_frozen_code_collection[$index],
                        'product_code' => $product_code,
                    ];

                    $this->mode === "production" ? DB::table('products_brand')->insert($productBrandData) : '';
                }

        /*
         | Operation record 记录操作
         | 
        */
            
        $operationData = [
            'email' => auth()->user()->email,
            'operation_type' => 'Update',
            'operation_category' => 'Product',
        ];

        $this->mode === "production" ? Operation::create($operationData) : '';

        return redirect()->route('backend.admin.product.edit-product-more', ['productCode' => $product_code]);
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