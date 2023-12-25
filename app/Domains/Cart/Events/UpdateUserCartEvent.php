<?php

namespace App\Domains\Cart\Events;

use  App\Domains\Cart\Models\Cart;
use Illuminate\Http\Request;

class UpdateUserCartEvent{

    public function updateUserCart(Request $request){

        try{

            // Define variable
            $email = auth()->user()->email;
            $brand_code = $request->brand_code;
            $number = $request->number;

            $cart = Cart::where('user_email', $email)
                ->where('sku_id', $brand_code)
                ->first();

            $cart->update([
                'number' => $number
            ]);

            $data = [
                'code' => $brand_code,
                'number' => $number
            ];

        }catch(\Exception $err){

            $data = [
                'status' => 'error',
                'message' => $err->getMessage(),
                'line' => $err->getLine(),
                'file' => $err->getFile(),
            ];

        }

        return response()->json($data);

    }

}