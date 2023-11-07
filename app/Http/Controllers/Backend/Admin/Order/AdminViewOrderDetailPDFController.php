<?php

namespace App\Http\Controllers\Backend\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminViewOrderDetailPDFController extends Controller
{
    public function adminViewOrderDetailPDF($orderID){

        $mode = "preview"; // download or preview
        
        $order = Order::where('code', $orderID)
            ->first();

        if($mode === "download"){
    
            $pdf = Pdf::loadView('backend.admin.order.order-detail-pdf', compact('order'))
                    ->setPaper('A4', 'portrait', 'margin-top: 0');
    
            $pdf->render();
            $pdf->stream();
            $now = now()->addHours(8);
            $nowModifier = str_replace('_','-', $now);
            return $pdf->download("$orderID-$nowModifier-order.pdf");

        }else{

            $html = view('backend.admin.order.order-detail-pdf', compact('order'));
            $htmlpdf = PDF::loadHTML($html);
            $htmlpdf->render();
            return $htmlpdf->stream();

        }
        
    }
}
