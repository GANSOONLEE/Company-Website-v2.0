<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class UserViewOrderDetailController extends Controller
{
    public function userViewOrderDetail($order_code){

        $order = Order::where('code', $order_code)->first();

        return view('backend.user.order-detail', compact('order'));
    }
}
