<?php

namespace App\Domains\Cart\Events;

use Illuminate\Http\Request;

class CreateCartEvent{

    public function createCart(Request $request)
    {
        $brand_code = $request->brand;
        $quantity = $request->quantity;

        auth()->user()->createCartRecord($brand_code, $quantity);

        return redirect()->back();
    }

}