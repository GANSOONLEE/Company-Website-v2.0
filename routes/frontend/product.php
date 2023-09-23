<?php

use Illuminate\Support\Facades\Route;

// Get
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\productDetailController;

Route::get('category', [CategoryController::class, 'category'])
    ->name('category');

Route::group(['prefix' => 'product'], function(){

    // GET

    Route::get('{category}', [ProductController::class, 'product'])
        ->name('product');

    Route::get('detail/{productCode}', [productDetailController::class, 'productDetail'])
        ->name('product-detail');

});