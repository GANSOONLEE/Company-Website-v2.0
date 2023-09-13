<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller{

    public function product($category){

        $product = Product::where('product_category', $category)
            ->get();

        return view('frontend.product', compact('productData'));

    }

}