<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Brand\EditBrandController;
use App\Http\Controllers\Backend\Admin\Brand\CreateBrandController;

use App\Domains\Brand\Events\BrandUpdateEvent;
use App\Domains\Brand\Events\BrandCreateEvent;

use App\Domains\Brand\Http\Controllers\BrandController;

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function(){

    Route::get('create', [BrandController::class, 'create'])
        ->name('create');

    Route::post('/', [BrandController::class, 'store'])
        ->name('store');

    Route::get('edit', [BrandController::class, 'edit'])
        ->name('edit');

    Route::patch('{id}', [BrandController::class, 'update'])
        ->name('update');

    Route::delete('{id}', [BrandController::class, 'destroy'])
        ->name('destroy');
});