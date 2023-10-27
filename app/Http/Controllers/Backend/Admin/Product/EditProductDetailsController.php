<?php

namespace App\Http\Controllers\Backend\Admin\Product;
use App\Http\Controllers\Controller;
use App\Models\Product;

class EditProductDetailsController extends Controller{

    public function editProductMoreDetails($productCode){

        $product = Product::where('product_code', $productCode)
                    ->first();

        return view('backend.admin.product.edit-product-detail', compact('product'));
    }

}