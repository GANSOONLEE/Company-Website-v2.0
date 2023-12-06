<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Product\CreateProductController;
use App\Http\Controllers\Backend\Admin\Product\EditProductController;
use App\Http\Controllers\Backend\Admin\Product\EditProductDetailsController;

use App\Domains\Product\Events\CreateProductEvent;
use App\Domains\Product\Events\DeleteProductImageEvent;
use App\Domains\Product\Events\DeleteProductEvent;
use App\Domains\Product\Events\SearchProductEvent;
use App\Domains\Product\Events\UpdateProductEvent;

// test

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    // GET
    Route::get('create-product', [CreateProductController::class, 'createProduct'])
        ->name('create-product');

    Route::get('list', [EditProductController::class, 'editProduct'])
        ->name('edit-product');

    Route::get('update-product/{productCode}', [EditProductDetailsController::class, 'editProductMoreDetails'])
        ->name('edit-product-detail');

    // Post
    Route::post('create-product', [CreateProductEvent::class, 'createProduct'])
        ->name('create-product-post');

    // Put
    Route::put('update-product/{product_code}', [UpdateProductEvent::class, 'updateProduct'])
        ->name('edit-product-detail-put');

    // Delete
    Route::delete('delete-image', [DeleteProductImageEvent::class, 'deleteImage'])
        ->name('delete-image');

    Route::post('delete-product/{product_code}', [DeleteProductEvent::class, 'deleteProduct'])
        ->name('delete-product');

    // Route::post('search-product',  [SearchProductEvent::class, 'searchProduct'])
    //     ->name('search-product');

    Route::get('search-product',  [SearchProductEvent::class, 'searchProduct'])
        ->name('search-product');
    
});