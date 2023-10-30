<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Events\CreateProductEvent;
use App\Domains\Product\Events\UpdateProductEvent;
use App\Domains\Product\Events\DeleteProductImageEvent;

Route::group(['prefix' => 'product', 'as' => 'product.'], function(){

    Route::post('product-create-post', [CreateProductEvent::class, 'createProduct'])->name('create');

    Route::post('product-edit-post', [UpdateProductEvent::class, 'updateProduct'])->name('edit');

    Route::post('image-delete-api', [DeleteProductImageEvent::class, 'deleteImage']);
});