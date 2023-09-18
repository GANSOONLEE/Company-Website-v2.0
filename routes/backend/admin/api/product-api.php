<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Events\CreateProductEvent;

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    Route::post('product-create-post', [CreateProductEvent::class, 'createProduct'])->name('create');
});