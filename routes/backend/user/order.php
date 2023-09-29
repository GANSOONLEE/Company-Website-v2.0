<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\User\UserViewOrderController;
use App\Http\Controllers\Backend\User\UserViewOrderDetailController;

Route::get('order',[UserViewOrderController::class, 'userViewOrder'])->name('order');
Route::get('order/detail/{orderID}',[UserViewOrderDetailController::class, 'userViewOrderDetail'])->name('order-detail');

// Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

//     // GET

// });
