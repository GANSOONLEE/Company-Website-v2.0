<?php

namespace App\Domains\Product\Events;

use App\Domains\Product\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class ProductDeleted extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $product;
    
    public function __construct(Product $product)
    {
        // Logs operation
        $this->$product = $product;
        $this->createOperation('delete', 'product', $product->product_code);

        DB::table('carts')
            ->leftJoin('products_brand', 'products_brand.code', '=', 'carts.sku_id')
            ->leftJoin('products', 'products.product_code', '=', 'products_brand.product_code')
            ->where('products.id', $product->id)
            ->delete();
            
        DB::table('orders_detail')
            ->leftJoin('products_brand', 'products_brand.code', '=', 'orders_detail.sku_id')
            ->leftJoin('products', 'products.product_code', '=', 'products_brand.product_code')
            ->where('products.id', $product->id)
            ->delete();

    }
}