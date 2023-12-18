<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Http\Controllers\ProductController;


Route::group(['prefix' => 'product', 'as' => 'product.'], function()
{

    // Product Management Center
    Route::get('/', [ProductController::class, 'index'])
        ->name('index');

    // Product Management Center > Create Panel
    Route::get('create', [ProductController::class, 'create'])
        ->name('create');

    // Product Management Center > Management Panel
    Route::get('management/{page?}', [ProductController::class, 'management'])
        ->name('management');

    // Product Management Center > Management Panel > edit Panel
    Route::get('edit/{id}', [ProductController::class, 'edit'])
        ->name('edit');

    // Product Management Center > Management Panel
    Route::get('search', [ProductController::class, 'search'])
        ->name('search');

    // Store Product
    Route::post('/', [ProductController::class, 'store'])
        ->name('store');

    // Update Product
    Route::patch('{id}', [ProductController::class, 'update'])
        ->name('update');

    // Delete Product (Soft)
    Route::delete('/product/{id}', [ProductController::class, 'delete'])
        ->name('delete');

    // Delete Product (Force)
    Route::delete('/deleted-product/{id}', [ProductController::class, 'destroy'])
        ->name('destroy');
    
    // Delete Image (Force)
    Route::delete('image', [ProductController::class, 'destroyImage'])
        ->name('delete-image');
    
});