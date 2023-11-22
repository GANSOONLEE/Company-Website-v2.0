<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteProductEvent{

    public function deleteProduct(Request $request, $product_code){

        // check product existent
        $product = Product::where('product_code', $product_code)->first();

        if(!$product){
            return false;
        }

        // check product brand information
        $brands = DB::table('products_brand')
                    ->where('product_code', $product_code)
                    ->get();

        // check product name information
        $names = DB::table('products_name')
                    ->where('product_code', $product_code)
                    ->get();    

        // delete product
        $product->delete();

        return redirect()->back();
    }


}