<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;
use App\Models\CarModel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller{

    public function product($category){

        $productData = Product::select(
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),    
                'products.*',
                'products_name.product_code',
                'products_name.name',
            )
            ->join('products_name', 'products.product_code', '=', 'products_name.product_code')
            ->where('products.product_category', $category)
            ->where('products.product_status', 'Public')
            ->groupBy('products_name.product_code', 'products_name.name')
            ->orderBy('first_name', 'asc')
            ->get();

        $directory = "storage/product/$category";

        $typeData = Type::orderBy('name', 'asc')
                        ->get();
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'typeData', 'modelData', 'category'));

    }

}