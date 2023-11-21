<?php

namespace App\Domains\Cart\Events;

use Illuminate\Http\Request;

class CreateCartEvent{

    public function createCart(Request $request)
    {
        try {
            $brand_code = $request->brand;
            $quantity = $request->quantity;
    
            $user = auth()->user();
    
            if(!$user){
                return redirect()->route('auth.login');
            }
    
            $user->createCartRecord($brand_code, $quantity);

            $status = [
                'status' => trans('product.upload-successful'),
                'icon' => 'success',
            ];
        }catch(\Exception $e){
            $status = [
                'status' => trans('product.upload-failure'),
                'icon' => 'error',
            ];
        }

        return redirect()->back();
    }

}