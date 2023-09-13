<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "product_code";
    protected $fillable = [
        'product_code',
        'product_category',
        'product_type',
        'product_status',
    ];

    /**
     * Function
     */

    public function getProductBrand(){

        return DB::table('prducts_brand')
        ->select('product_code', 'sku_id', 'brand', 'code')
        ->where('product_code', $this->product_code)
        ->get();

    }

    public function getProductName(){

        return DB::table('prducts_name')
        ->select('product_code', 'name')
        ->where('product_code', $this->product_code)
        ->get();

    } 


}
