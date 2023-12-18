<?php

namespace App\Domains\Model\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

use App\Domains\Model\Models\Traits\Relationship\ModelRelationship;
use App\Domains\Model\Models\Traits\Scope\ModelScope;

class Model extends BaseModel
{
    use HasFactory,
        ModelRelationship,
        ModelScope;

    protected $table = "models";
    protected $primaryKey = "id";
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

}
