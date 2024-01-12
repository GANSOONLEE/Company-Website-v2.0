<?php

namespace App\Domains\Category\Models;

// Model
use App\Domains\Category\Models\Traits\Method\CategoryMethod;
use App\Domains\Category\Models\Traits\Relationship\CategoryRelationship;
use App\Domains\Category\Models\Traits\Scope\CategoryScope;

// Laravel Support
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,
        CategoryMethod,
        CategoryRelationship,
        CategoryScope;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'orderId',
    ];
}
