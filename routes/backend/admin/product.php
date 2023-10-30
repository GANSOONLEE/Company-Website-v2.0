<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Product\EditProductController;
use App\Http\Controllers\Backend\Admin\Product\CreateProductController;
use App\Http\Controllers\Backend\Admin\Product\EditProductDetailsController;

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    // GET
    Route::get('product-create', [CreateProductController::class, 'createProduct'])
        ->name('product-create');

    Route::get('product-edit/{productCode?}', [EditProductController::class, 'editProduct'])
        ->name('product-edit');

    Route::get('product-edit/details/{productCode?}', [EditProductDetailsController::class, 'editProductMoreDetails'])
        ->name('edit-product-more');
    
});