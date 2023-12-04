<?php

namespace App\Http\Controllers\Frontend;

// Laravel Support
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Model
use App\Models\Product;
use App\Models\Type;
use App\Models\CarModel;

class ProductController extends Controller{

    public function product($category){

        $productData = [];

        $product_code = DB::table('products_name')
            ->select(
                'products.product_code',
                DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(name ORDER BY name), ",", 1) AS name'),
                'products_name.product_code'
                )
            ->join('products','products.product_code','=','products_name.product_code')
            ->when(!auth()->user() || auth()->user()->getRoleEntity()->name != "root", function ($query){
                $query->where('products.product_status', 'Public');
            })
            ->where('products.product_category', $category)
            ->groupBy('products.product_code')
            ->orderBy('name', 'asc')
            ->get();
            
        foreach($product_code as $code){
            $product = Product::where('product_code', $code->product_code)
                ->first();

            if(!$product){
                continue;
            }

            // Defined variable
            $category = $product->product_category;
            $code = $product->product_code;

            // Get Image
            if(auth()->user()->email == 'vincentgan0402@gmail.com'){

                $images = Storage::disk('public')->files("product/$category/$code");
                $product_cover = '' ; 
                $product_image = [] ; 
                $brand_cover = [] ;
    
                foreach($images as $image){
    
                }
    
    
                // $product->product_image = 
                
                // if(){
    
                // }
    
                // dd($product);
                
            }
            $productData[] = $product; 
        }

        $directory = "storage/product/$category";

        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category'));

    }

}