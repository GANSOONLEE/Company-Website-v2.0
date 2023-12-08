<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderController;
use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderDetailController;
use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderDetailPDFController;

use App\Domains\Order\Events\ChangeOrderStatusEvent;


Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // GET
    Route::get('/', [AdminViewOrderController::class, 'adminViewOrder'])
        ->name('index');

    Route::get('detail/{orderID}',[AdminViewOrderDetailController::class, 'adminViewOrderDetail'])
        ->name('order-detail');

    Route::get('detail/pdf/{orderID}', [AdminViewOrderDetailPDFController::class, 'adminViewOrderDetailPDF'])
        ->name('order-detail-pdf');

    // Put
    Route::put('/change-order-status', [ChangeOrderStatusEvent::class, 'changeOrderStatus'])
        ->name('change-order-status');

});