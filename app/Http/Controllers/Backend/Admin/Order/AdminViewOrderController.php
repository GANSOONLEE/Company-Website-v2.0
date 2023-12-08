<?php

namespace App\Http\Controllers\Backend\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminViewOrderController extends Controller
{
    public function adminViewOrder(){
     
        $orderData = Order::orderBy('created_at', 'desc')
                        ->get();

        return view('backend.admin.order.view-order', compact('orderData'));

    }

}
