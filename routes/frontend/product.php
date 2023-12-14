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

    Route::get('{category}', [ProductController::class, 'list'])
        ->name('list');

    Route::get('{category}/{model}', [ProductController::class, 'query'])
        ->name('query');

    Route::get('{productCode}', [productDetailController::class, 'productDetail'])
        ->name('detail');

});