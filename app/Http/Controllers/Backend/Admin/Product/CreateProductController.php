<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Domains\Category\Models\Category;
use App\Domains\Brand\Models\Brand;
use App\Models\Type;
use App\Domains\Model\Models\Model;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function createProduct(){

        // Check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_product'))){
            abort(403, 'Insufficient permissions');
        };

        $categoryData = Category::orderBy('name', 'asc')
                            ->get();
        $brandData = Brand::orderBy('name', 'asc')
                            ->get();
        $modelData = Model::orderBy('name', 'asc')
                            ->get();

        return view('backend.admin.product.create-product', compact('categoryData', 'brandData', 'modelData'));
    }
}
