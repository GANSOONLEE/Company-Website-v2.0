<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchProductEvent{

    public $searchText;
    public $searchCategory;
    public $searchType;

    public function searchProduct(Request $request){

        // Define variable
        $searchText = $request->text;
        $searchCategory = $request->category;
        $searchType = $request->type;
        $this->searchText = $searchText;
        $this->searchCategory = $searchCategory;
        $this->searchType = $searchType;

        $searchTextResult = '';
        $searchCategoryResult = '';
        $searchTypeResult = '';

        if(!isset($this->searchText) && !isset($this->searchCategory) && !isset($this->searchType)){
            return redirect()->route('backend.admin.product.product-edit');
        }

        if(isset($this->searchText)){
            $searchTextResult = Product::select(
                    "products.*", 
                    "products_name.product_code",
                    "products_name.name"
                )
                ->join("products_name", "products.product_code","=","products_name.product_code")
                ->where("products_name.name", "LIKE", "%$this->searchText%")
                ->groupBy("products_name.product_code", "products_name.name")
                ->orderBy("products_name.name", "asc")
                ->get();
        }else{
            $searchTextResult = Product::all();
        }

        if(isset($this->searchCategory)){
            $searchCategoryResult = Product::where('product_category', $searchCategory)->get();
        }else{
            $searchCategoryResult = Product::all();
        }

        if(isset($this->searchType)){
            $searchTypeResult = Product::where('product_type', $searchType)->get();
        }else{
            $searchTypeResult = Product::all();
        }

        $commonEntities = array_intersect(
            $searchTextResult->pluck('product_code')->toArray(),
            $searchCategoryResult->pluck('product_code')->toArray(),
            $searchTypeResult->pluck('product_code')->toArray()
        );

        
        $productData = DB::table('products_name')
            ->select(
                "products.*",
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                "products_brand.brand",
                "products_brand.code",
                "products_brand.frozen_code",
            )
            ->join('products', 'products.product_code', '=', 'products_name.product_code')
            ->join('products_brand', 'products_brand.product_code', '=', 'products_name.product_code')
            ->whereIn('products.product_code', $commonEntities)
            ->groupBy(
                'products_name.product_code',
                // 'products_name.name',
                'products.id',
                "products_brand.brand",
                "products_brand.code",
                "products_brand.frozen_code"
            )
            ->orderBy('first_name', 'asc')
            ->get();
            
        $categoryData = \App\Models\Category::all();
        $typeData = \App\Models\Type::all();

        $text = $this->searchText;
        $category = $this->searchCategory;
        $type = $this->searchType;

        return view("backend.admin.product.edit-product", compact('productData', 'categoryData', 'typeData', 'text', 'category', 'type'));
    }

}