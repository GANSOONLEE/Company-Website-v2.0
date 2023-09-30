<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderController;
use App\Http\Controllers\Backend\Admin\Order\AdminViewOrderDetailController;


Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // GET
    Route::get('/', [AdminViewOrderController::class, 'adminViewOrder'])->name('index');
    Route::get('detail/{orderID}',[AdminViewOrderDetailController::class, 'adminViewOrderDetail'])->name('order-detail');

});