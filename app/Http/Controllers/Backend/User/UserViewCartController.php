<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Category;

class UserViewCartController extends Controller
{
    public function userViewCart(){

        $user = auth()->user()->email;
        $cartData = Cart::where('user_email', $user)
                        ->get();

        $categoryData = Category::all();

        return view('backend.user.cart', compact('cartData', 'categoryData'));

    }
}
