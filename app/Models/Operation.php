<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Operation extends Model
{
    use HasFactory;

    protected $table = "operations";
    protected $fillable = [
        'email',
        'operation_type',
        'operation_category'
    ];

    public function getUserByOperation(){
        return User::where('email', $this->email)->first();
    }
}
