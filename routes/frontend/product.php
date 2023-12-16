<?php

use Illuminate\Support\Facades\Route;

// Get
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\productDetailController;


Route::group(['prefix' => 'product', 'as' => 'product.'], function()
{
    
    Route::get('category', [CategoryController::class, 'category'])
        ->name('index');

    Route::get('category/{category}', [ProductController::class, 'list'])
        ->name('list');

    Route::get('category/{category}/{model}', [ProductController::class, 'query'])
        ->name('query');

    Route::get('detail/{productCode}', [productDetailController::class, 'productDetail'])
        ->name('detail');

    // except CSRF route
    Route::get('search', [ProductController::class, 'search'])
        ->name('search');

    Route::post('cart/{productCode}', [ProductController::class, 'cart'])
        ->name('cart');
});