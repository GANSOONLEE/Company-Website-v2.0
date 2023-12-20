<?php

namespace App\Domains\Cart\Models;

use App\Domains\Cart\Models\Traits\Method\CartMethod;
use App\Domains\Cart\Models\Traits\Relationship\CartRelationship;
use App\Domains\Cart\Models\Traits\Scope\CartScope;

// Laravel Support
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory,
        CartMethod,
        CartRelationship,
        CartScope;

    protected $table = "carts";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_email',
        'sku_id',
        'number'
    ];

}
