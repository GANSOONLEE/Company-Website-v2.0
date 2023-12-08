<?php

namespace App\Domains\Auth\Models\Traits\Scope;

trait UserScope
{
 
    /**
     * @param $query
     * @param $state
     * 
     * @return mixed
     */
    public function scopeByState($query, $state)
    {
        return $query->where('status', $state);
    }

    
}