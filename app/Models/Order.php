<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $fillable = [
        'code',
        'user_email',
        'status',
    ];

    /**
     * Relationship
     */
    
    public function getItemCount(){

        return DB::table('orders_detail')
                ->where('order_id', $this->code)
                ->count();

    }

    public function getOrderItems(){

        // $orderDetails = DB::table('orders_detail')
        //     ->where('order_id', $this->code)
        //     ->join('products_brand', 'orders_detail.sku_id', '=', 'products_brand.sku_id')
        //     ->join('products_name', 'products_brand.product_code', '=', 'products_name.product_code')
        //     ->join('products', 'products_brand.product_code', '=', 'products.product_code')
        //     ->orderBy('products.product_category', 'asc')
        //     ->get();

        $orderDetails = DB::table('orders_detail')
            ->where('order_id', $this->code)
            ->join('products_brand', 'orders_detail.sku_id', '=', 'products_brand.sku_id')
            ->join('products', 'products_brand.product_code', '=', 'products.product_code')
            ->join('products_name', 'products_brand.product_code', '=', 'products_name.product_code')
            ->select('products_brand.code',
                DB::raw('MIN(products_brand.sku_id) as sku_id'),
                DB::raw('MIN(products_brand.brand) as brand'),
                DB::raw('MIN(orders_detail.order_id) as order_id'),
                DB::raw('MIN(products.product_category) as product_category'),
                DB::raw('MIN(products.product_code) as product_code'),
                DB::raw('MIN(products_name.name) as name'),
                DB::raw('MIN(orders_detail.number) as number')
            )
            ->groupBy('products_brand.code')
            ->orderBy('product_category', 'asc')
            ->orderBy('name', 'asc')
            ->orderBy('brand', 'asc')
            ->get();

        return $orderDetails;

    }

    public function getUserInformation(){

        return User::where('email', $this->user_email)
                    ->first();

    }

    public static function getOrderNew(){
        return Order::where('status', 'Placed')
                ->count();
    }
}
