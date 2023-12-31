<?php

namespace App\Domains\Cart\Models\Traits\Scope;


// Enum
use App\Domains\Common\Enums\Sort;

// Laravel Support
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait CartScope
{
    /**
     * Return collection sort by create time
     * @param Builder $query
     * @param Sort $sort
     * 
     * @return Builder
     */
    public function scopeByUpdateTime(Builder $query, ?Sort $sort = null): Builder
    {
        return $query->orderBy('updated_at', $sort ?? Sort::ASC());
    }

    /**
     * Return collection sort by product name
     * @param Builder $query
     * @param Sort $sort
     * 
     * @return Builder
     */
    public function scopeByProductName(Builder $query, ?Sort $sort = null): Builder
    {
        return $query->select(
                'carts.*',
                'products.id as product_id',
                'products_name.id as name_id',
                'products_name.name',
                'products_brand.id as brand_id',
                'products_brand.brand',
            )
            ->leftJoin('products_brand', 'carts.sku_id', '=', 'products_brand.code')
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products_brand.product_code')
            ->leftJoin('products', 'products.product_code', '=', 'products_name.product_code')
            ->groupBy('carts.id')
            ->orderBy('products.product_category')
            ->orderBy('products_name.name', $sort ?? Sort::ASC());
    }
}