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
            
            // $pusher = new \Pusher\Pusher(
            //     "a018306a14faf67a1d14",
            //     "f20516edef6fc1ed85ff",
            //     "1699531",
            //     array('cluster' => 'ap1')
            // );

            // $pusher->trigger('private-product-detail-channel', \App\Events\TestMessageSend::class, array('total_cart' => $user->getCartNumber()));

            $status = [
                'status' => trans('product.upload-successful'),
                'icon' => 'success',
                'total_cart' => $user->getCartNumber(),
            ];
        }catch(\Exception $e){
            $status = [
                'status' => trans('product.upload-failure'),
                'icon' => 'error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
        }

        return response()->json($status);
    }

}