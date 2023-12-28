<?php

namespace App\Domains\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;

class Operation extends Model
{
    use HasFactory;

    protected $table = "operations";
    protected $fillable = [
        'email',
        'operation_type',
        'operation_category',
        'operation_detail',
    ];
    
}