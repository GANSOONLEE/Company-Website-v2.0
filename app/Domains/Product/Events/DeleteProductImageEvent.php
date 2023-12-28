<?php

namespace App\Domains\Product\Events;
use App\Domains\Product\Models\Product;
use App\Domains\Data\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteProductImageEvent{

    public function deleteImage(Request $request){

        try{

            // Define variable
            $imageName = urldecode($request->imageName);
            $product_code = $request->product_code;
            $type = $request->type;
            
            if($type === "brand"){
                $brand_code = $request->brand_code;
            }else{
                $brand_code = '';
            }

            // Get Product Information
            $productInstance = Product::where('product_code', $product_code)->first();
            $category = $productInstance->product_category;

            // Define Path Parameter
            $diskName = 'public';
            $directory = "product/$category/$product_code";
            $path = "";

            if($type === "brand"){
                $oldBrandCover = Storage::disk($diskName)->exists($directory . '/'. $brand_code . '/' . $imageName);

                if($oldBrandCover){
                    // Verify validation
                    $path = Storage::disk($diskName)->delete($directory . '/'. $brand_code . '/'. $imageName);
                }
            }else{
                $path = Storage::disk($diskName)->exists($directory . '/' . $imageName);

                if($path){
                    // Verify validation
                    $path = Storage::disk($diskName)->delete($directory . '/' . $imageName);
                }
            }

            // Delete Image
            
            // Record Operation
            $operationData = [
                "email" => auth()->user()->email,
                "operation_type" => 'Update',
                "operation_category" => 'Product',
            ];

            Operation::create($operationData);

            // Response
            $status = [
                "name" => $imageName,
                "path" => $path,
                "message" => trans('product.update-successful'),
                "status" => true,
            ];

        }catch(\Exception $e){

            $status = [
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "error" => $e->getMessage(),
                "message" => trans('product.update-failure'),
                "status" => false,
            ];

        }

        return response()->json($status);

    }

}