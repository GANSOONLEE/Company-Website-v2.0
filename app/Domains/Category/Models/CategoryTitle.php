<?php

namespace App\Domains\Category\Models;

// Model
use App\Domains\Category\Models\Traits\Relationship\CategoryTitleRelationship;

// Laravel Support
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTitle extends Model
{
    use HasFactory,
        CategoryTitleRelationship;

    protected $table = 'categories_title';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'order'
    ];
}
