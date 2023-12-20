<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Domains\Cart\Models\Cart;
use App\Domains\Category\Models\Category;
use App\Models\Type;

class UserViewCartController extends Controller
{
    public function userViewCart(){

        $user = auth()->user()->email;
        $cartData = Cart::where('user_email', $user)
                        ->get();

        $categoryData = Category::all();
        $typeData = Type::all();

        return view('backend.user.cart', compact('cartData', 'categoryData', 'typeData'));

    }
}
