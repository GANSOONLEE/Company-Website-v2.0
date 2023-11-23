<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;
use App\Models\CarModel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller{

    public function product($category){

        // $productData = Product::select(
        //         DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),    
        //         'products.*',
        //         'products_name.product_code',
        //         'products_name.name',
        //     )
        //     ->join('products_name', 'products.product_code', '=', 'products_name.product_code')
        //     ->where('products.product_category', $category)
        //     ->where('products.product_status', 'Public')
        //     ->groupBy('products_name.name', 'products_name.product_code')
        //     ->orderBy('first_name', 'asc')
        //     ->get();

        $productData = [];

        $product_code = DB::table('products_name')
            ->select(
                'products.product_code',
                DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(name ORDER BY name), ",", 1) AS name'),
                'products_name.product_code'
                )
            ->join('products','products.product_code','=','products_name.product_code')
            ->when(auth()->user()->getRoleEntity()->name != "root", function ($query){
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
            $productData[] = $product; 
        }

        $directory = "storage/product/$category";

        $typeData = Type::orderBy('name', 'asc')
                        ->get();
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'typeData', 'modelData', 'category'));

    }

}