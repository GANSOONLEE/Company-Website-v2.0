<?php

namespace App\Http\Controllers\Frontend;

// Laravel Support
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Model
use App\Domains\Product\Models\Product;
use App\Models\Type;
use App\Models\CarModel;

class ProductController extends Controller{

    public function list($category){

        $productData = Product::where('product_category', $category)
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->orderBy('products_name.name')
            ->get(['products.*']);

        $directory = "storage/product/$category";
        $modelData = CarModel::orderBy('name', 'asc')->get();

        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category'));

    }

    /**
     * Search product by Category and Model 
     * 
     * @param string $category
     * @param string $model
     */
    public function query(string $category, string $model){

        $productData = Product::where('product_category', $category)
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->where('products_name.name', 'LIKE', "%$model%")
            ->orderBy('products_name.name')
            ->get(['products.*']);

        // Defined variable
        $directory = "storage/product/$category";
        $modelData = CarModel::orderBy('name', 'asc')->get();

        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category', 'model'));
    }

}