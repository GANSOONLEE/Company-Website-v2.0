<?php

namespace App\Domains\Auth\Models\Traits\Scope;

trait RoleScope
{
 
    protected $orderSupport = ['asc', 'desc'] ;

    /**
     * @param $query
     * @param $state
     * 
     * @return mixed
     */
    public function scopeByWeight($query, $order)
    {
        
        if(in_array($order, $this->orderSupport)){
            return $query->orderBy('weight', $order);
        }else{
            throw new \InvalidArgumentException("The order attribute $order is not supported.");
        }
    }

    
}