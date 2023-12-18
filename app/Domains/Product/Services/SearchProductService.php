<?php

namespace App\Domains\Product\Services;

use App\Domains\Model\Models\Model;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Domains\Product\Models\Product;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class SearchProductService{

    public function searchProduct($category, Request $request){
        
        $model = $request->model;

        // check are empty filter
        if(empty($model)){
            return redirect()->route('frontend.product.list', ['category'=>$category]);
        }

        $productData = [];

        if(!empty($model)){
            $product_code = DB::table('products_name')
                ->select(
                    'products.product_code',
                    DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(name ORDER BY name), ",", 1) AS name'),
                    'products_name.product_code'
                )
                ->join('products','products.product_code','=','products_name.product_code')
                ->where('name', 'like', "%$model%")
                ->where('products.product_category', $category)
                ->groupBy('products.product_code')
                ->orderBy('name', 'asc')
                ->get();
            
            $products = [];
            foreach($product_code as $code){
                $product = Product::where('product_code', $code->product_code)
                    ->first();
                if(!$product){
                    continue;
                }
                $productData[] = $product; 
            }
        }

        // Define variable
        $directory = "storage/product/$category";
                        
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category'));

    }

}