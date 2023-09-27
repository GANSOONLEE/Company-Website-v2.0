<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_email',
        'sku_id',
        'number'
    ];

    /**
     * Relationship
     */

    public function getProductInformation($data){
        $brand = DB::table('products_brand')
                    ->where('sku_id', $this->sku_id)
                    ->first();

        $product = Product::where('product_code', $brand->product_code)
                    ->first();

        return $product->$data;
    }

    public function getBrandInformation($data){
        $brand = DB::table('products_brand')
                    ->where('sku_id', $this->sku_id)
                    ->first();

        return $brand->$data;
    }

    public function getProductInformationEntity(){
        $brand = DB::table('products_brand')
        ->where('sku_id', $this->sku_id)
        ->first();

        $product = Product::where('product_code', $brand->product_code)
                ->first();

        return $product;
    }
}
