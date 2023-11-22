<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteProductImageEvent{

    public function deleteImage(Request $request){

        try{

            // Define variable
            $imageName = urldecode($request->imageName);
            $product_code = $request->product_code;
            $brand_code = $request->brandCode;

            // Get Product Information
            $productInstance = Product::where('product_code', $product_code)->first();
            $category = $productInstance->product_category;

            // Define Path Parameter
            $diskName = 'public';
            $directory = "product/$category/$product_code/";

            // Verify validation
            $oldImage = Storage::disk($diskName)->exists($directory . $brand_code . '/' . $imageName);
            if(!$oldImage){
                new \Exception('Can\'t find this image');
                return false;
            }

            // Delete Image
            $result = Storage::disk($diskName)->delete($directory . $brand_code . '/'. $imageName);
            
            // Record Operation
            $operationData = [
                "email" => auth()->user()->email,
                "operation_type" => 'Update',
                "operation_category" => 'Product',
            ];

            Operation::create($operationData);

            // Response
            $status = [
                "result" => "success",
            ];

        }catch(\Exception $e){

            $status = [
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "message" => $e->getMessage()
            ];

        }

        return response()->json($status);

    }

}