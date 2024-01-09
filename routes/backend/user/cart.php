
<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Cart\Http\Controllers\CartController;

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function(){

    Route::get('create', [CartController::class, 'create'])
        ->name('create');

    Route::post('store', [CartController::class, 'store'])
        ->name('store');

    Route::patch('/update/{brand}', [CartController::class, 'update'])
        ->name('update');

    Route::delete('/delete/{brand}', [CartController::class, 'delete'])
        ->name('delete');

});