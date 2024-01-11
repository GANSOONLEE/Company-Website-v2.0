<?php

namespace App\Domains\Order\Models\Traits\Method;

use Illuminate\Support\Facades\DB;

trait OrderMethod
{

    /**
     * Get order detail sort by Category and Name
     * @return mixed
     */
    public function sortDetailByCategory(): mixed
    {
        return DB::table('orders_detail')
            ->select(
                'orders_detail.*',
                'orders_detail.id as detail_id',
                'orders_detail.remarks as detail_remarks',
                'products_brand.*',
                'products_name.*',
                'products.*',
            )
            ->where('orders_detail.order_id', $this->code)
            ->leftJoin('products_brand', 'products_brand.code', '=', 'orders_detail.sku_id')
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products_brand.product_code')
            ->leftJoin('products', 'products.product_code', '=', 'products_brand.product_code')
            ->groupBy('orders_detail.sku_id')
            ->orderBy('products.product_category')
            ->orderBy('products_name.name');
    }
}