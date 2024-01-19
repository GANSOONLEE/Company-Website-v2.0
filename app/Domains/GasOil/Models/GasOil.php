<?php

namespace App\Domains\GasOil\Models;

// Laravel Support
use Illuminate\Database\Eloquent\Model;

class GasOil extends Model
{

    protected $table = "gas_oil";
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

}