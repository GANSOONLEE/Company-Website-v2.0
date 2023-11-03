<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Events\ChangeOrderStatusEvent;

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // POST
    Route::post('/change-order-status', [ChangeOrderStatusEvent::class, 'changeOrderStatus'])->name('change-order-status');

});