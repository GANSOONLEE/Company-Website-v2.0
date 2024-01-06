<?php

namespace App\Domains\Order\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait OrderScope
{
    /**
     * @param Builder $query
     * @param string|bool $state
     * @return Builder
     */
    public function scopeByState(Builder $query, string|bool $state = false): Builder
    {
        $query->where(function ($query) {
            $query->where('created_at', '>', now()->subDays(45))
                  ->orWhere(function ($query) {
                      $query->where('created_at', '<=', now()->subDays(45))
                            ->where('status', '!=', 'Completed');
                  });
        })->orderBy('created_at', 'desc');
        

        if(is_string($state)){
            return $query->where('status', $state);
        }
        return $query->orderBy('status');
    }

    /**
     * Get order history
     * @param Builder $query
     * @param int $days
     * @return Builder
     */
    public function scopeByHistory(Builder $query, int $days = 45): Builder
    {
        return $query->where('created_at', '<', now()->subDays(45))->where('status', 'Completed')->orderBy('created_at', 'desc');
    }
}