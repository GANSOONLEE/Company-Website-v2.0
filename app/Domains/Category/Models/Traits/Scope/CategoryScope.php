<?php

namespace App\Domains\Category\Models\Traits\Scope;

trait CategoryScope
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