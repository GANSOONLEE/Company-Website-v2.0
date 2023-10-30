<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function editProduct($productCode = null){
        // Check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_product'))){
            abort(403, 'Insufficient permissions');
        };

        if(isset($productCode)){
            $product = Product::where('product_code', $productCode)->first();
        }else{
            $product = null;
        }
            
        $productData = Product::select('products.*')
            ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->groupBy('products.product_code')
            ->orderByRaw('SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.name), \',\', 1) ASC')
            ->get();

        $categoryData = Category::orderBy('name', 'asc')
                            ->get();

        $typeData = Type::orderBy('name', 'asc')
                            ->get();

        $productStatuses = Product::pluck('product_status');
        $statusData = collect($productStatuses)->unique();

        return view('backend.admin.product.edit-product', compact('categoryData', 'typeData', 'productData', 'statusData', 'product'));
    }
}
