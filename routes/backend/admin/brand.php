<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Brand\EditBrandController;
use App\Http\Controllers\Backend\Admin\Brand\CreateBrandController;

use App\Domains\Brand\Events\BrandUpdateEvent;
use App\Domains\Brand\Events\BrandCreateEvent;

use App\Domains\Brand\Http\Controllers\BrandController;

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function(){

    // Get
    // Route::get('brand-create', [CreateBrandController::class, 'createBrand'])
    //     ->name('brand-create');

    // Route::get('brand-edit', [EditBrandController::class, 'editBrand'])
    //     ->name('brand-edit');

    // // Post
    // Route::post('create-brand', [BrandCreateEvent::class, 'brandCreate'])
    //     ->name('create');

    // // Put
    // Route::put('update-brand', [BrandUpdateEvent::class, 'brandUpdate'])
    //     ->name('update');

    # TODO: BrandController

    Route::get('create', [BrandController::class, 'create'])
        ->name('create');

    Route::post('/', [BrandController::class, 'store'])
        ->name('store');

    Route::get('edit', [BrandController::class, 'edit'])
        ->name('edit');

    Route::patch('{category}', [BrandController::class, 'update'])
        ->name('update');

    Route::delete('{category}', [BrandController::class, 'destroy'])
        ->name('destroy');
});