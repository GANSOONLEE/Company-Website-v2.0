<?php

namespace App\Domains\Auth\Models\Traits\Scope;

trait UserScope
{
 
    /**
     * @param $query
     * 
     * @return mixed
     */
    public function scopeByPage($query)
    {
        return $query;
    }

}