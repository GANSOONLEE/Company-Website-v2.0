<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Http\Controllers\OrderController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
    
    Route::get('/', [OrderController::class, 'userList'])
        ->name('index');
    
    Route::get('/detail/{id}', [OrderController::class, 'detailUser'])
        ->name('detail');

    // Store Order [Action]
    Route::post('/', [OrderController::class, 'store'])
        ->name('store');

    Route::post('/detail/{id}', [OrderController::class, 'stoneItem'])
        ->name('stoneItem');

    Route::patch('/detail/{id}', [OrderController::class, 'modifyItem'])
        ->name('modifyItem');

    Route::delete('/detail/{id}', [OrderController::class, 'dropItem'])
        ->name('dropItem');

});
