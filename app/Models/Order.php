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

        $orderDetails = DB::table('orders_detail')
            ->where('order_id', $this->code)
            ->join('products_brand', 'orders_detail.sku_id', '=', 'products_brand.sku_id')
            ->join('products', 'products_brand.product_code', '=', 'products.product_code')
            ->orderBy('products.product_category', 'asc')
            ->get();

        return $orderDetails;

    }

    public function getUserInformation(){

        return User::where('email', $this->user_email)
                    ->first();

    }
}
