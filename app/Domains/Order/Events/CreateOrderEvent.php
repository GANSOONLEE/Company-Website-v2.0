<?php

namespace App\Domains\Order\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Order;
use App\Events\NewOrderEvent;
use Pusher\Pusher;

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
                        
            };

            $orderNewCount = Order::where('status', 'Placed')->count();
            $pusher = new Pusher(
                "a018306a14faf67a1d14",
                "f20516edef6fc1ed85ff",
                "1699531",
                array('cluster' => 'ap1')
            );

            $pusher->trigger('admin-sidebar-channel', 'create-order-event', array('order' => $orderNewCount));

            $status = [
                'status' => 'success',
                'orderItems' => $orderItems,
                'order_code' => $order_code,
                // 'pusher' => $pusher,
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