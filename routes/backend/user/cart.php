
<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Cart\Http\Controllers\CartController;

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function(){

    Route::get('create', [CartController::class, 'create'])
        ->name('create');

    Route::post('store', [CartController::class, 'store'])
        ->name('store');

    Route::patch('update', [CartController::class, 'update'])
        ->name('update');

});