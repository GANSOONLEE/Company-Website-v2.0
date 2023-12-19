<?php

namespace App\Http\Controllers\Backend\Admin\Product;
use App\Http\Controllers\Controller;
use App\Domains\Brand\Models\Brand;
use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class EditProductDetailsControllerOld extends Controller{

    public function editProductMoreDetails($productCode){

        $product = Product::where('product_code', $productCode)
                    ->first();

        $disk = "public";
        $directory = "product/$product->product_category/$productCode";
        $productCover = '';
        $productImages = [];
        $brandCover = [];

        // Group Image
        $productImage = Storage::disk($disk)->files($directory);
        foreach($productImage as $image){
            // Are Product Cover
            if(strpos($image, 'cover')){
                $productCover = $image;
                continue;
            }else{
                $productImages[] = $image;
            }
        }

        $categories = Category::orderBy('name', 'asc')
                        ->get();
                        
        $brands = Brand::orderBy('name', 'asc')
                        ->get();
                        
        $types = Type::orderBy('name', 'asc')
                        ->get();
                        

        return view('backend.admin.product.edit-product-detail', compact('product', 'categories' ,'types', 'brands', 'productImages'));
    }

}