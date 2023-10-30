<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;
use App\Models\CarModel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller{

    public function product($category){

        $productData = Product::where('product_category', $category)
            ->where('product_status', 'Public')
            ->orderBy(function ($query) {
                $query->select(DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(name ORDER BY name), ',', 1)"))
                    ->from('products_name')
                    ->whereColumn('products_name.product_code', 'products.product_code');
            })
            ->get();

        $directory = "storage/product/$category";

        $typeData = Type::orderBy('name', 'asc')
                        ->get();
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'typeData', 'modelData', 'category'));

    }

}