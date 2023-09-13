<?php

use Illuminate\Support\Facades\Route;

// Get
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;

Route::get('category', [CategoryController::class, 'category'])->name('category');

Route::group(['prefix' => 'product'], function(){

    Route::get('{category}', [ProductController::class, 'product'])->name('product');

});