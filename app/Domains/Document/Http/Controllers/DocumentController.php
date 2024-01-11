<?php

namespace App\Domains\Document\Http\Controllers;

// Model
use App\Domains\Order\Models\Order;

// Service
use App\Domains\Document\Services\DocumentService;
use App\Domains\Product\Models\Product;
// Third-Party Support
use Barryvdh\DomPDF\Facade\Pdf;

// Laravel Support
use Illuminate\Support\Facades\DB;

class DocumentController
{

    public $documentService;

    // public function __construct(DocumentService $documentService)
    // {
    //     $this->documentService = $documentService;
    // }

    /**
     * preview pdf file
     */
    public function pdf(string $orderId)
    {
        $order = Order::find($orderId);
        $detail = $order->sortDetailByCategory()->get();
        $headers = [
            trans('Id'),
            trans('product.category'),
            trans('product.name'),
            trans('product.brand'),
            trans('order.number'),
            trans('order.remark'),
        ];

        $data = [
            'order' => $order,
            'detail' => $detail,
            'headers' => $headers,
        ];

        $pdf = Pdf::loadView('pdf.order', $data);
        return $pdf->stream();
    }

}