<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderController;
use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderDetailController;
use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderDetailPDFController;
use App\Domains\Order\Events\ChangeOrderStatusEvent;


use App\Domains\Brand\Http\Controllers\OrderController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // GET
    // Route::get('/', [AdminViewOrderController::class, 'adminViewOrder'])
    //     ->name('index');

    // Route::get('detail/{orderID}',[AdminViewOrderDetailController::class, 'adminViewOrderDetail'])
    //     ->name('order-detail');

    // Route::get('detail/pdf/{orderID}', [AdminViewOrderDetailPDFController::class, 'adminViewOrderDetailPDF'])
    //     ->name('order-detail-pdf');

    // // Put
    // Route::put('/change-order-status', [ChangeOrderStatusEvent::class, 'changeOrderStatus'])
    //     ->name('change-order-status');

    # TODO: OrderController

    // View Order [View]
    Route::get('index', [OrderController::class, 'index'])
        ->name('index');
    
    // Order History [View]
    Route::get('list', [OrderController::class, 'list'])
        ->name('list');

    // Create Order [View]
    Route::get('create', [OrderController::class, 'create'])
        ->name('create');

    // Store Order [Action]
    Route::post('/', [OrderController::class, 'store'])
        ->name('store');

    // Edit Order [View]
    Route::get('edit', [OrderController::class, 'edit'])
        ->name('edit');

    // Modify Order [Action]
    Route::patch('{category}', [OrderController::class, 'update'])
        ->name('update');

    // Soft Delete Order [Action]
    Route::delete('{category}', [OrderController::class, 'delete'])
        ->name('delete');

    // Force Delete Order [Action]
    Route::delete('deleted/{category}', [OrderController::class, 'destroy'])
        ->name('destroy');

});