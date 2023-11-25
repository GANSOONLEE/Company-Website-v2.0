<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Events\CreateProductEvent;
// use App\Domains\Product\Events\UpdateProductEvent;
use App\Domains\Product\Events\DeleteProductImageEvent;
use App\Domains\Product\Events\DeleteProductEvent;
use App\Domains\Product\Events\SearchProductEvent;
use App\Domains\Product\Events\UpdateProductEvent;

// test
use App\Domains\Product\Events\CreateProductTestEvent;

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    Route::post('create/post', [CreateProductEvent::class, 'createProduct'])->name('create');

    // Route::post('product-edit-post/{product_code}', [UpdateProductEvent::class, 'updateProduct'])->name('edit');

    Route::post('image-delete-api', [DeleteProductImageEvent::class, 'deleteImage']);

    Route::post('search',  [SearchProductEvent::class, 'searchProduct'])->name('search');
    Route::get('search',  [SearchProductEvent::class, 'searchProduct'])->name('search');

    Route::get('/delete/{product_code}', [DeleteProductEvent::class, 'deleteProduct'])->name('delete');

    
    Route::post('edit/post/{product_code}', [UpdateProductEvent::class, 'updateProduct'])->name('edit');
    
});