<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Type;

class UserDataController extends Controller
{
    public function userData(){

        $user = auth()->user();

        return view('backend.user.data', compact('user'));

    }
}