<?php

namespace App\Domains\Order\Events;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateOrderEvent{

    public function createOrder(Request $request){

        try{

            // Define variable
            
            /**
             * @param array $orderAggregation
             */
            $orderItems = $request->orderData;

            /**
             * create order basic information
             */

            $order_code = $this->createOrderInformationBasic();

            /**
             * create order detail
             */

            foreach($orderItems as $orderItem){
                $this->createOrderDetail($orderItem, $order_code);
            }

            /**
             * adjust cart number to 0
             */

            foreach($orderItems as $orderItem){

                Cart::where('user_email', auth()->user()->email)
                        ->where('sku_id', $orderItem['sku_id'])
                        ->update([
                            'number' => 0,
                        ]);
                        
            }

            $status = [
                'status' => 'success',
                'orderItems' => $orderItems,
                'order_code' => $order_code,
            ];

        }catch(\Exception $err){
            $status = [
                'status' => 'error',
                'message' => $err->getMessage(),
                'line' => $err->getLine(),
                'file' => $err->getFile(),
            ];
        }

        return response()->json($status);
    }
    
    private function createOrderInformationBasic(): string{

        $code = $this->generateCode();

        Order::create([
            'code' => $code,
            'user_email' => auth()->user()->email,
            'status' => 'Placed',
        ]);

        return $code;

    }

    private function createOrderDetail($orderItem, $order_code){

        DB::table('orders_detail')->insert([
            'order_id' => $order_code,
            'sku_id' => $orderItem['sku_id'],
            'number' => $orderItem['number'],
        ]);

    }

    public function generateCode(){
        $code = Str::random(8);
        if(Order::where('code', $code)->first()){
            $this->generateCode();
        }

        return $code;
    }

}