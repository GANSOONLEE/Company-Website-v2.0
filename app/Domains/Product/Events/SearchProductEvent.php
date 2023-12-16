<?php

namespace App\Domains\Product\Events;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SearchProductEvent{

    public $searchText;
    public $searchCategory;
    public $searchCode;

    public function searchProduct(Request $request){

        // Define variable
        $searchText = $request->text;
        $searchCategory = $request->category;
        $searchCode = $request->code;

        $this->searchText = $searchText;
        $this->searchCategory = $searchCategory;
        $this->searchCode = $searchCode;

        $searchTextResult = '';
        $searchCategoryResult = '';
        $searchCodeResult = '';

        if(!isset($this->searchText) && !isset($this->searchCategory) && !isset($this->searchCode)){
            return redirect()->route('backend.admin.product.edit-product');
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
            $searchTextResult = Product::select(
                "products.*", 
                "products_name.product_code",
                "products_name.name"
            )
            ->join("products_name", "products.product_code","=","products_name.product_code")
            ->groupBy("products_name.product_code", "products_name.name")
            ->orderBy("products_name.name", "asc")
            ->get();
        }

        if(isset($this->searchCategory)){
            $searchCategoryResult = Product::select(
                    "products.*",
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_name.name",
                )
                ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
                ->where('product_category', $searchCategory)
                ->groupBy("products.id", 'products_name.name')
                ->orderBy("first_name", "asc")
                ->get();
        }else{
            $searchCategoryResult = Product::select(
                "products.*",
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                "products_name.name",
            )
            ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->groupBy("products.id", 'products_name.name')
            ->orderBy("first_name", "asc")
            ->get();
        }

        if(isset($this->searchCode)){

            $searchCodeResult = DB::table('products_brand')
                ->select(
                    "products.*",
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_brand.product_code",
                    "products_brand.code"
                )
                ->where("products_brand.code", "LIKE", "%$this->searchCode%")
                ->join('products_name', 'products_name.product_code', '=', 'products_brand.product_code')
                ->join("products", "products.product_code","=","products_brand.product_code")
                ->orderBy("first_name", "asc")
                ->groupBy('products.id', 'products_brand.code')
                ->get();

        }else{
            $searchCodeResult = DB::table('products_brand')
                ->select(
                    "products.*",
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_brand.product_code",
                    "products_brand.code"
                )
                ->join('products_name', 'products_name.product_code', '=', 'products_brand.product_code')
                ->join("products", "products.product_code", "=", "products_brand.product_code")
                ->groupBy(
                    'products.id',
                    'products_brand.code'
                )
                ->orderBy("first_name", "asc")
                ->get();
            }

        $commonEntities = array_intersect(
            $searchTextResult->pluck('product_code')->toArray(),
            $searchCategoryResult->pluck('product_code')->toArray(),
            $searchCodeResult->pluck('product_code')->toArray()
        );

        
        $productData = collect();
        
        foreach ($commonEntities as $key => $entity) {
            $result = DB::table('products_name')
                ->select(
                    "products.*",
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_brand.code",
                    "products_brand.product_code",
                    "products.updated_at",
                    "products_brand.brand",
                )
                ->join('products', 'products.product_code', '=', 'products_name.product_code')
                ->join('products_brand', 'products_brand.product_code', '=', 'products_name.product_code')
                ->where('products.product_code', $entity)
                // ->when(isset($this->searchCode), function ($query) {
                //     return $query->where('products_brand.code', [$this->searchCode]);
                // })
                ->groupBy(
                    'products_name.product_code',
                    'products_name.name',
                    'products.id',
                    "products_brand.code",
                    "products_brand.brand",
                )
                ->orderBy('first_name', 'asc')
                ->first();
            

            if ($result && !$productData->contains('product_code', $result->product_code)) {
                $productData->push($result);
            }
        }

        // 现在 $productData 包含了每个 $commonEntities 对应的第一个符合条件的记录
        // 
        // auth()->user()->email == "vincentgan0402@gmail.com" ? dd($searchCodeResult, $commonEntities, count($commonEntities), $productData) : '';

        $categoryData = \App\Models\Category::all();
        $typeData = \App\Models\Type::all();

        $text = $this->searchText;
        $category = $this->searchCategory;
        $code = $this->searchCode;


        return view("backend.admin.product.edit-product", compact('productData', 'categoryData', 'typeData', 'text', 'category', 'code'));
    }

}