<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Cart\Events\CreateCartEvent;

Route::group(['prefix'=>'product', 'as'=>'product.'], function(){

    Route::post('detail/{productCode}', [CreateCartEvent::class, 'createCart'])->name('detail.post');

});