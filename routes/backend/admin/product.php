<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Product\EditProductController;
use App\Http\Controllers\Backend\Admin\Product\CreateProductController;

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    // GET
    Route::get('product-create', [CreateProductController::class, 'createProduct'])
        ->name('product-create');

    Route::get('product-edit/{productCode?}', [EditProductController::class, 'editProduct'])
        ->name('product-edit');
    
});