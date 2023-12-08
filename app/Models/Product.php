<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";
    protected $primaryKey = "product_code";
    public $incrementing = false; 
    protected $fillable = [
        'product_code',
        'product_category',
        'product_type',
        'product_status',
        'faker',
        'updated_at'
    ];

    /**
     * Function
     */

    public function getProductBrand(){

        return DB::table('products_brand')
        ->select('product_code', 'sku_id', 'brand', 'code', 'frozen_code')
        ->where('product_code', $this->product_code)
        ->get();

    }

    public function getProductName(){

        return DB::table('products_name')
        ->select('product_code', 'name')
        ->where('product_code', $this->product_code)
        ->get();

    }

    public function deleteWithRelatedRecords(){

        // Brand
        DB::table('products_brand')->where('product_code', $this->product_code)->delete();

        // Name
        DB::table('products_name')->where('product_code', $this->product_code)->delete();

        // Product
        $this->delete();
    }

    public function deleteWithRelatedRecordsForce(){

        // Brand
        DB::table('products_brand')->where('product_code', $this->product_code)->delete();

        // Name
        DB::table('products_name')->where('product_code', $this->product_code)->delete();

        // Product
        $this->forceDelete();
    }

    public static function forceDeleteRemarkRecords($day = 3){
        
        $thresholdDate = now()->subDays($day)->addHours(8);
        $products = Product::withTrashed()
                        ->where('deleted_at', '<' , $thresholdDate)
                        ->orderBy('deleted_at', 'asc')
                        ->get();

        foreach($products as $product){
            $product->deleteWithRelatedRecords();
            $product->forceDelete();
        }
    }
}
