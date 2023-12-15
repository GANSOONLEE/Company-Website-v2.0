<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\Image\CarouselImageController;

use App\Domains\Image\Events\CarouselImageUpdateEvent;
use App\Domains\Image\Events\CarouselImageDeleteEvent;
use App\Domains\Image\Events\CarouselImageUploadEvent;
use App\Domains\Image\Events\CarouselCreatePanelEvent;

use App\Domains\Image\Http\Controllers\ImageController;

Route::group(['prefix' => 'image', 'as' => 'image.'], function(){

    // GET
    // Route::get('/carousel-image', [CarouselImageController::class, 'carouselImage'])->name('carousel-image');

    // Route::post('carousel-image-update', [CarouselImageUpdateEvent::class, 'carouselImageUpdate'])
    //     ->name('carousel-image-update');

    // Route::post('carousel-image-delete', [CarouselImageDeleteEvent::class, 'carouselImageDelete'])
    //     ->name('carousel-image-delete');

    // Route::post('carousel-image-upload', [CarouselImageUploadEvent::class, 'carouselImageUpload'])
    //     ->name('carousel-image-upload');

    // Route::post('carousel-create-panel', [CarouselCreatePanelEvent::class, 'carouselCreatePanel'])
    //     ->name('carousel-create-panel');

    # TODO: ImageController
    
    Route::get('/', [ImageController::class, 'index'])
        ->name('index');

    Route::get('create', [ImageController::class, 'create'])
        ->name('create');

    Route::post('/', [ImageController::class, 'store'])
        ->name('store');

    Route::get('edit', [ImageController::class, 'edit'])
        ->name('edit');

    Route::patch('{image}', [ImageController::class, 'update'])
        ->name('update');

    Route::delete('{image}', [ImageController::class, 'destroy'])
        ->name('destroy');

});