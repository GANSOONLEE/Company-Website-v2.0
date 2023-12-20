<?php

namespace App\Domains\Cart\Events;
use  App\Domains\Cart\Models\Cart;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSearchCartEvent{

    public $searchName;
    public $searchCategory;

    public function searchCart(Request $request){

        // Define variable
        $searchName = $request->name;
        $searchCategory = $request->category;

        $this->searchName = $searchName;
        $this->searchCategory = $searchCategory;

        $searchNameResult = '';
        $searchCategoryResult = '';

        if(!isset($this->searchName) && !isset($this->searchCategory)){
            return redirect()->route('backend.user.cart');
        }

        if(isset($this->searchName)){
            $searchNameResult = Cart::select(
                    "carts.*",
                    "products_brand.sku_id",
                    "products_brand.product_code",
                    "products_name.product_code",
                    "products_name.name"
                )
                ->join("products_brand", "carts.sku_id","=","products_brand.sku_id")
                ->join("products_name", "products_brand.product_code","=","products_name.product_code")
                ->where("products_name.name", "LIKE", "%$this->searchName%")
                ->where("carts.user_email", auth()->user()->email)
                ->groupBy("products_name.product_code", "products_name.name", "carts.id")
                ->orderBy("products_name.name", "asc")
                ->get();

        }else{
            $searchNameResult = Cart::select(
                "carts.*", 
                "products_name.product_code",
                "products_name.name"
            )
            ->join("products_brand", "carts.sku_id","=","products_brand.sku_id")
            ->join("products_name", "products_brand.product_code","=","products_name.product_code")
            ->groupBy("products_name.product_code", "products_name.name", "carts.id")
            ->orderBy("products_name.name", "asc")
            ->get();
        }

        if(isset($this->searchCategory)){
            $searchCategoryResult = Product::select(
                    "products.*",
                    "carts.*",
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_name.name",
                )
                ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
                ->join('products_brand', 'products_brand.product_code', '=', 'products.product_code')
                ->join('carts', 'carts.sku_id', '=', 'products_brand.sku_id')
                ->where('product_category', $searchCategory)
                ->where("carts.user_email", auth()->user()->email)
                ->groupBy("products.id", 'carts.id', 'products_name.name')
                ->orderBy("first_name", "asc")
                ->get();
            
        }else{
            $searchCategoryResult = Product::select(
                "products.*",
                "carts.*",
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                "products_name.name",
            )
            ->join('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->groupBy("products.id", 'products_name.name')
            ->orderBy("first_name", "asc")
            ->get();
        }

        $commonEntities = array_intersect(
            $searchNameResult->pluck('product_code')->toArray(),
            $searchCategoryResult->pluck('product_code')->toArray(),
        );

        
        $cartData = collect();
        
        foreach ($commonEntities as $key => $entity) {
            $result = DB::table('products_name')
                ->select(
                    "carts.*",
                    'products.*',
                    DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(products_name.name ORDER BY products_name.product_code), ',', 1) as first_name"),
                    "products_brand.code",
                    "products_brand.product_code",
                    "products_brand.sku_id",
                    "products_brand.brand",
                )
                ->join('products_brand', 'products_brand.product_code', '=', 'products_name.product_code')
                ->join('products', 'products.product_code', '=', 'products_brand.product_code')
                ->join('carts', 'carts.sku_id', '=', 'products_brand.sku_id')
                ->where('products_brand.product_code', $entity)
                // ->when(isset($this->searchCode), function ($query) {
                //     return $query->where('products_brand.code', [$this->searchCode]);
                // })
                ->groupBy(
                    'products_name.product_code',
                    'products_name.name',
                    'carts.id',
                    'products.id',
                    "products_brand.code",
                    "products_brand.brand",
                )
                ->orderBy('first_name', 'asc')
                ->first();
            

            if ($result && !$cartData->contains('product_code', $result->product_code)) {
                $cartData->push($result);
            }
        }

        // 现在 $productData 包含了每个 $commonEntities 对应的第一个符合条件的记录
        // 
        // auth()->user()->email == "vincentgan0402@gmail.com" ? dd($searchCodeResult, $commonEntities, count($commonEntities), $productData) : '';

        $categoryData = \App\Domains\Category\Models\Category::all();

        $name = $this->searchName;
        $category = $this->searchCategory;

        return view("backend.user.cart", compact('cartData', 'categoryData', 'name', 'category'));
    }

}

