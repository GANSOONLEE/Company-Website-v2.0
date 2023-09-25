<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;

class ProductController extends Controller{

    public function product($category){

        $productData = Product::where('product_category', $category)
            ->where('product_status', 'Public')
            ->get();

        $directory = "storage/product/$category";

        $typeData = Type::all();

        return view('frontend.product', compact('productData', 'directory', 'typeData'));

    }

}