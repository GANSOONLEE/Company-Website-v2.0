<?php

namespace App\Http\Controllers\Backend\Admin\Order;

use App\Http\Controllers\Controller;
use App\Domains\Order\Models\Order;
use Illuminate\Http\Request;

class AdminViewOrderDetailController extends Controller
{
    public function adminViewOrderDetail($orderID){

        $order = Order::where('code', $orderID)
                    ->first();

        return view('backend.admin.order.order-detail', compact('order'));
        
    }
}
