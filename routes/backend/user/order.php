<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Http\Controllers\OrderController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
    
    Route::get('/', [OrderController::class, 'userList'])
        ->name('index');
    
    Route::get('detail', [OrderController::class, 'detail'])
        ->name('detail');

});
