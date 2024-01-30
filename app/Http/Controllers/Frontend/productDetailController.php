<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productDetailController extends Controller
{
    public function productDetail($productDetail){

        // Define variable
        $productCode = $productDetail;

        // Get Product Instance
        $productData = Product::where('product_code', $productCode)
            ->first();

        // Define variable
        $disk = "public";
        $directory = "product/$productData->product_category/$productCode";
        $productCover = '';
        $productImages = [];
        $brandCover = [];

        // Group Image
        $productImage = Storage::disk($disk)->files($directory);
        foreach($productImage as $image){

            $name = basename(substr($image, 0, strripos($image, '.')));

            // Are Product Cover
            if($name === 'cover' && $productCover === ''){
                $productCover = $image;
                continue;
            }else{
                $productImages[] = $image;
            }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
        }

        // Brand Cover
        $subdirectories = Storage::disk($disk)->allDirectories($directory);
        foreach($subdirectories as $index => $subdirectory){
            // Get Folder Name
            $pathParts = explode('/', $subdirectory);
            $subDirectoryName = end($pathParts);

            $image =  Storage::disk($disk)->files($subdirectory);
            $brandCover[$subDirectoryName]= $image;
        }

        return view('frontend.product-detail', compact(
            'productData',
            'productCover',
            'productImages',
            'brandCover',
        ));

    }
}
