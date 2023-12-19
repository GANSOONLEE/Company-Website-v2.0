<?php

namespace App\Domains\Brand\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;

use Illuminate\Support\Facades\DB;

trait BrandRelationship
{

    /**
     * Category relationship with products 
     */
    public function products()
    {
        return DB::table('products_brand')
                ->where('brand', $this->name)
                ->groupBy('product_code');

    }

}