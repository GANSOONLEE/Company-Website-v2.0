<?php

namespace App\Http\Controllers\Backend\Admin\Product;

// Laravel Support
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

// Model
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Models\CarModel;

class EditProductDetailsController extends Controller{

    public function editProductMoreDetails($productCode){

        $product = Product::where('product_code', $productCode)
                    ->first();

        $disk = "public";
        $baseDirectory = "product/$product->product_category/$productCode";

        if(!$productCode){
            abort(404);
        }
        
        $productMedia = [];
        $productImages = [];

        // Group Image
        $productMedia = Storage::disk($disk)->files($baseDirectory);

        $productCoverArray = array_filter($productMedia, function ($image) {
            return strpos($image, 'cover') !== false;
        });
        foreach($productCoverArray as $index => $image){
            $imageInstance = new UploadedFile(Storage::disk($disk)->path($image), $image);
            $productImages["product-0"] = (object)[
                "path" => 'storage/' . $image,
                "name" => $imageInstance->getClientOriginalName(),
                "extension" => $imageInstance->getClientOriginalExtension(),
            ];
        }
        

        $productImagesArray = array_filter($productMedia, function ($image) {
            return strpos($image, 'cover') === false;
        });

        foreach($productImagesArray as $index => $image){
            $imageInstance =  new UploadedFile(Storage::disk($disk)->path($image), $image);
            $productImages["product-" . $index + 1] = (object)[
                "path" => 'storage/' . $image,
                "name" => $imageInstance->getClientOriginalName(),
                "extension" => $imageInstance->getClientOriginalExtension(),
            ];
        }

        $categoryData = Category::orderBy('name', 'asc')
                        ->get();
                        
        $brandData = Brand::orderBy('name', 'asc')
                        ->get();
                        
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();
                        

        return view('backend.admin.product.edit-product-detail', compact('product', 'categoryData' , 'brandData' , 'modelData', 'productImages'));
    }

}