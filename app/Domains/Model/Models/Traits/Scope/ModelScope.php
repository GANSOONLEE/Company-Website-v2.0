<?php

namespace App\Domains\Model\Models\Traits\Scope;

trait ModelScope{

    public function scopeByName($query, $order = 'asc')
    {
        return $query->orderBy('name', $order);
    }

}