<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductEvent{

    public function searchProduct(Request $request){

        // Define variable
        $searchText = $request->text;
        $searchCategory = $request->category;
        $searchType = $request->type;

        $searchTextResult = '';
        $searchCategoryResult = '';
        $searchTypeResult = '';

        if(!isset($searchText) && !isset($searchCategory) && !isset($searchType)){
            return redirect()->route('backend.admin.product.product-edit');
        }

        if(isset($searchText)){
            $searchTextResult = Product::select(
                    "products.*", 
                    "products_name.product_code",
                    "products_name.name"
                )
                ->join("products_name", "products.product_code","=","products_name.product_code")
                ->where("products_name.name", "LIKE", "%$searchText%")
                ->groupBy("products_name.product_code", "products_name.name")
                ->orderBy("products_name.name", "asc")
                ->get();
        }else{
            $searchTextResult = Product::all();
        }

        if(isset($searchCategory)){
            $searchCategoryResult = Product::where('product_category', $searchCategory)->get();
        }else{
            $searchCategoryResult = Product::all();
        }

        if(isset($searchType)){
            $searchCategoryResult = Product::where('product_type', $searchType)->get();
        }else{
            $searchCategoryResult = Product::all();
        }

        $commonEntities = array_intersect(
            $searchTextResult->pluck('product_code')->toArray(),
            $searchCategoryResult->pluck('product_code')->toArray(),
            $searchCategoryResult->pluck('product_code')->toArray()
        );

        $productData = Product::whereIn('product_code', $commonEntities)->get();

        $categoryData = \App\Models\Category::all();
        $typeData = \App\Models\Type::all();

        return view("backend.admin.product.edit-product", compact('productData', 'categoryData', 'typeData'));
    }

}