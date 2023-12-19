<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            
        $productData = Product::select(
                'products.*',
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                "products_brand.brand",
                "products_brand.code",
                "products_brand.frozen_code",
            )
            ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->join('products_brand', 'products_brand.product_code', '=', 'products_name.product_code')
            ->groupBy('products.product_code',
                "products_brand.brand",
                "products_brand.code",
                "products_brand.frozen_code")
            ->orderBy('first_name', 'asc')
            ->get();

        $categoryData = Category::orderBy('name', 'asc')
                            ->get();

        $productStatuses = Product::pluck('product_status');
        $statusData = collect($productStatuses)->unique();

        return view('backend.admin.product.edit-product', compact('categoryData', 'productData', 'statusData', 'product'));
    }
}
