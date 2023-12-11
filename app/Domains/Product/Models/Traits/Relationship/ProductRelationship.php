<?php

namespace App\Domains\Product\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;

use Illuminate\Support\Facades\DB;

trait ProductRelationship
{
    
    /**
     * Get the brand relationship brand instance
     * @return mixed
     */

    public function brands(): mixed
    {
        $records = Product::join('products_brand', 'products.product_code' , '=', 'products_brand.product_code');

        return $records;
    }

    /**
     * Get the names relationship names instance
     * @return mixed
     */
    public function names(): mixed
    {
        $records = Product::join('products_name', 'products.product_code' , '=', 'products_name.product_code');

        return $records;
    }

}