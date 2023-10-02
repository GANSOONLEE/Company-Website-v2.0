<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function editProduct(){
        // Check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_product'))){
            abort(403, 'Insufficient permissions');
        };

        $productData = Product::orderBy('product_category', 'asc')->get();
        $categoryData = Category::all();
        $typeData = Type::all();

        $productStatuses = Product::pluck('product_status');
        $statusData = collect($productStatuses)->unique();

        return view('backend.admin.product.edit-product', compact('categoryData', 'typeData', 'productData', 'statusData'));
    }
}
