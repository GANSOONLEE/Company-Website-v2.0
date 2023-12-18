<?php

namespace App\Domains\Model\Models\Traits\Relationship;

use Illuminate\Support\Facades\DB;

trait ModelRelationship{

    /**
     * car model and products relationship
     */
    public function products()
    {
        return DB::table('products_name')
                ->where('name', 'LIKE', "%$this->name%")
                ->groupBy('name')
                ->count();
    }

}