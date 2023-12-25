<?php

namespace App\Domains\Brand\Models\Traits\Scope;

trait BrandScope
{
    /**
     * Return category by name 
     * @param string $order
     */
    public function scopeByName($query, string $order = 'asc')
    {
        return $query->orderBy('name', $order);
    }
}