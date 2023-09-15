<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function createProduct(){

        // Check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_product'))){
            abort(403, 'Insufficient permissions');
        };

        $categoryData = Category::all();
        $brandData = Brand::all();

        return view('backend.admin.product.create-product', compact('categoryData', 'brandData'));
    }
}
