<?php

namespace App\Domains\Category\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\CategoryTitle;

trait CategoryRelationship
{

    /**
     * Category relationship with products 
     */
    public function products()
    {
        return Product::where('product_category', $this->name);
    }

    public function title()
    {
        return CategoryTitle::find($this->orderId);
    }

}