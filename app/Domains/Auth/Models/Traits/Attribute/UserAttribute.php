<?php

namespace App\Domains\Auth\Models\Traits\Attribute;

trait UserAttribute
{

    public static function getJobOptionsAttribute()
    {
        return [
            'Owner',
            'Supplier',
            'Workshop',
        ];
    }
}