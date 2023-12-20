<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Domains\Cart\Models\Cart;
use App\Domains\Category\Models\Category;
use App\Models\Type;

class UserDataController extends Controller
{
    public function userData(){

        $user = auth()->user();

        return view('backend.user.data', compact('user'));

    }
}
