<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'order', 'as'=> 'order.'], function(){

    // POST
    Route::post('create-order',[CreateOrderEvent::class, 'creteOrder'])->name('create-order');

});