<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateProductEvent{

    public $mode = "debug"; // debug production
    public function updateProduct(Request $request, $product_code){

        // Define variable

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

            $category = $request->category;
            $type = $request->type;

            // Product Name
            $product_name_collection = $request->fullname;

            // Product Brand
            $product_brand_collection = $request->brand;
            $product_brand_code_collection = $request->input('brand-code');
            $product_frozen_code_collection = $request->input('frozen-code');

        // Upload Image

        $disk = 'public';
        $directory = "product/$category/$product_code";

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

        foreach($brand_image_collection as $key => $brandtImage){

            $brandCode = $product_brand_code_collection[$key-1];

            $originalName = $brandtImage->getClientOriginalName();
            $originalExtension = $brandtImage->getClientOriginalExtension();
            $modifierName = 'cover.' . $originalExtension;
            $path = $directory . '/' . $brandCode;

            // Check existent
            if(Storage::disk($disk)->exists($path)){
                continue;
            }

            $this->mode === "production" ? $brandtImage->storeAs($path, $modifierName, $disk) : '';
        }

        // Update Data

        
            $product = Product::where('product_code', $product_code)->first();

            // products [Table]
            $productData = [
                'product_category' => $category,
                'product_type' => $type,
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
                                        ->where('name', $name)
                                        ->exists();

                if($existentCheck){
                    continue;
                }

                $productNameData = [
                    'name' => $name,
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

            // Check deleted record
            foreach($deleteRecord as $record){   
                if($this->mode === "production"){
                    DB::table('products_brand')
                        ->where('code', $record)
                        ->delete();
                }
            }

            foreach($product_brand_collection as $index => $brand){

                // Check existent
                $existentCheck = DB::table('products_brand')
                                        ->where('code', $product_brand_code_collection[$index])
                                        ->exists();

                if($existentCheck){
                    continue;
                }

                $productBrandData = [
                    'brand' => $brand,
                    'brand_code' => $product_brand_code_collection[$index],
                    'frozen_code' => $product_frozen_code_collection[$index],
                ];

                $this->mode === "production" ? DB::table('products_brand')->insert($productBrandData) : '';
            }
            
        $operationData = [
            'email' => auth()->user()->email,
            'operation_type' => 'Update',
            'operation_category' => 'Product',
        ];

        $this->mode === "production" ? Operation::create($operationData) : '';

        return redirect()->route('backend.admin.product.edit-product-more', ['productCode' => $product_code]);
    }

}