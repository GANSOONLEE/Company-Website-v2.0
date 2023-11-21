<?php

namespace App\Domains\Product\Services;

use App\Models\CarModel;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class SearchProductService{

    public function searchProduct($category, Request $request){
        
        $search = $request->search;
        $type = $request->type;
        $model = $request->model;

        // dd(
        //     "您的 Category 為： $category",
        //     "您的 Type 為：$type",
        //     "您的 Model 為：$model",
        // );

        // check are empty filter
        if(empty($search) && empty($type) && empty($model)){
            return redirect()->route('frontend.product', ['category'=>$category]);
        }

        $typeResult = [];

        // build a query
        if(!empty($type)){
            $typeResult = Product::where('product_type', $type)
                        ->where('product_category', $category)
                        ->get();
        }

        $modelResult = '';

        if(!empty($model)){
            $product_code = DB::table('products_name')
                ->select(
                    'products.product_code',
                    DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(name ORDER BY name), ",", 1) AS name'),
                    'products_name.product_code'
                    )
                ->join('products','products.product_code','=','products_name.product_code')
                ->where('name', 'like', '%' . $model . '%')
                ->where('products.product_category', $category)
                ->groupBy('products.product_code')
                ->orderBy('name', 'asc')
                ->get();
            
            $products = [];
            foreach($product_code as $code){
                $product = Product::where('product_code', $code->product_code)
                    ->first();
                $products[] = $product; 
            }
            $modelResult = $products;
        }


        $productData = [];


        if(!empty($type) && !empty($model)){
            foreach ($typeResult as $typeData) {
                foreach ($modelResult as $modelData) {
                    if ($typeData->product_code === $modelData->product_code) {
                        $productData[] = $typeData;
                        break;
                    }
                }
            }
        }elseif(!empty($type)){
            $productData = $typeResult;
        }elseif(!empty($model)){
            $productData = $modelResult;
        }

        // Define variable
        $directory = "storage/product/$category";

        $typeData = Type::orderBy('name', 'asc')
                        ->get();
        $modelData = CarModel::orderBy('name', 'asc')
                        ->get();

        return view('frontend.product', compact('productData', 'directory', 'typeData', 'modelData', 'category'));

    }

}