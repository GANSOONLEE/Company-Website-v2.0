<?php

namespace App\Domains\Category\Models\Traits\Relationship;

use App\Domains\Category\Models\Category;

trait CategoryTitleRelationship
{

    /**
     * Category relationship with products 
     */
    public function category()
    {
        return Category::where('orderId', $this->id);
    }

}