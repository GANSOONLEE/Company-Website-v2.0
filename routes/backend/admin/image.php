<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\Image\CarouselImageController;

use App\Domains\Image\Events\CarouselImageUpdateEvent;
use App\Domains\Image\Events\CarouselImageDeleteEvent;
use App\Domains\Image\Events\CarouselImageUploadEvent;
use App\Domains\Image\Events\CarouselCreatePanelEvent;

use App\Domains\Image\Http\Controllers\ImageController;

Route::group(['prefix' => 'image', 'as' => 'image.'], function(){
    
    Route::get('/', [ImageController::class, 'index'])
        ->name('index');

    Route::get('create', [ImageController::class, 'create'])
        ->name('create');

    Route::post('/', [ImageController::class, 'store'])
        ->name('store');

    Route::get('management', [ImageController::class, 'management'])
        ->name('management');

    Route::get('permission', [ImageController::class, 'permission'])
        ->name('permission');

    Route::patch('{image}', [ImageController::class, 'update'])
        ->name('update');

    Route::delete('{image}', [ImageController::class, 'destroy'])
        ->name('destroy');

});