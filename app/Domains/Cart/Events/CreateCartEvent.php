<?php

namespace App\Domains\Cart\Events;

use Illuminate\Http\Request;

class CreateCartEvent{

    public function createCart(Request $request)
    {
        $brand_code = $request->brand;
        $quantity = $request->quantity;

        $user = auth()->user();

        if(!$user){
            return redirect()->route('auth.login');
        }

        $user->createCartRecord($brand_code, $quantity);

        return redirect()->back();
    }

}