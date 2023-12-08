<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Brand\EditBrandController;
use App\Http\Controllers\Backend\Admin\Brand\CreateBrandController;

use App\Domains\Brand\Events\BrandUpdateEvent;
use App\Domains\Brand\Events\BrandCreateEvent;

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function(){

    // Get
    Route::get('brand-create', [CreateBrandController::class, 'createBrand'])
        ->name('brand-create');

    Route::get('brand-edit', [EditBrandController::class, 'editBrand'])
        ->name('brand-edit');

    // Post
    Route::post('create-brand', [BrandCreateEvent::class, 'brandCreate'])
        ->name('create');

    // Put
    Route::put('update-brand', [BrandUpdateEvent::class, 'brandUpdate'])
        ->name('update');

    // Delete

});