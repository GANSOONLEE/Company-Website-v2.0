<?php

namespace App\Domains\Image\Models;

// Model Traits
use App\Domains\Image\Models\Traits\Attributes\ImageAttribute;
use App\Domains\Image\Models\Traits\Method\ImageMethod;

// Laravel Support
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use ImageAttribute,
        ImageMethod;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'allow_roles'
    ];

    protected $casts = [
        'allow_roles' => 'array',
    ];
}