<?php

namespace App\Domains\Order\Events;

use App\Domains\Data\Models\Operation;
use App\Domains\Order\Models\Order;
use App\Domains\Auth\Models\UserOperation;
use Illuminate\Http\Request;
use App\Events\NewOrderEvent;
use Illuminate\Support\Facades\Log;

class ChangeOrderStatusEvent{

    function changeOrderStatus(Request $request){

        try{
            $order = Order::where('code', $request->orderID)
                            ->first();
            
            $order->update([
                'status' => $request->newStatus
            ]);

            $response = [
                'status' => 'success',
            ];
        }catch(\Exception $e){
            
            $response = [
                'status' => 'error',
                'debug' => $e->getMessage(),
            ];
        }
        

        return response()->json($response);

    }

}