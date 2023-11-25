<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Product\CreateProductController;
use App\Http\Controllers\Backend\Admin\Product\EditProductController;
use App\Http\Controllers\Backend\Admin\Product\EditProductDetailsController;

// test

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    // GET

    Route::get('edit/{productCode?}', [EditProductController::class, 'editProduct'])
        ->name('product-edit');

    Route::get('create', [CreateProductController::class, 'createProduct'])
        ->name('product-create');

    Route::get('edit-details/{productCode?}', [EditProductDetailsController::class, 'editProductMoreDetails'])
        ->name('edit-product-more');
    
});