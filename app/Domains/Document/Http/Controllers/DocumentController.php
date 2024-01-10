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
        $details = $order->detail()->get();
        foreach ($details as $detail) {
            $category = Product::where(
                    'product_code',
                    DB::table('products_brand')
                        ->where('code', $detail->sku_id)
                        ->first()->product_code,
                    )
                    ->first()
                    ->product_category;

            $name = DB::table('products_name')->where(
                'product_code',
                DB::table('products_brand')
                    ->where('code', $detail->sku_id)
                    ->first()->product_code,
                )
                ->first()
                ->name;

            // add column
            $detail->category = $category;
            $detail->name = $name;
        }

        $detailArray = $details->toArray();

        usort($detailArray, function($a, $b) {
            $categoryComparison[] = strcmp($a->category, $b->category);
            return $categoryComparison !== 0 ? $categoryComparison : strcmp($a->name, $b->name);
        });

        $data = [
            'order' => $order,
            'detailArray' => $detailArray,
        ];

        $pdf = Pdf::loadView('pdf.order', $data);
        return $pdf->stream();
    }

}