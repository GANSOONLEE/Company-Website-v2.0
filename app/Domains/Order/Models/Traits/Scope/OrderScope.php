<?php

namespace App\Domains\Order\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait OrderScope
{
    /**
     * @param  $query
     * @param string|bool $state
     * @return Builder
     */
    public function scopeByState(Builder $query, string|bool $state = false): Builder
    {
        if(is_string($state)){
            return $query->where('status', $state);
        }

        return $query->orderBy('status') ;
            
    }
}