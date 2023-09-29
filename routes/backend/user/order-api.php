<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Events\CreateOrderEvent;

Route::group(['prefix'=>'order', 'as'=> 'order.'], function(){

    // POST
    Route::post('create-order',[CreateOrderEvent::class, 'createOrder'])->name('create-order');

});