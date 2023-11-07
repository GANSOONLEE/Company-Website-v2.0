<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public static function findProductName($brand_id){

        $product = DB::table('products_brand')
                ->where('code', $brand_id)
                ->first();

        return DB::table('products_name')
                ->where('product_code', $product->product_code)
                ->pluck('name')
                ->first();

    }
}
