<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Image\Events\CarouselImageUpdateEvent;
use App\Domains\Image\Events\CarouselImageDeleteEvent;
use App\Domains\Image\Events\CarouselImageUploadEvent;

Route::group(['prefix' => 'image', 'as' => 'image.'] , function(){

    // POST
    Route::post('carousel-image-update', [CarouselImageUpdateEvent::class, 'carouselImageUpdate'])
        ->name('carousel-image-update');

    Route::post('carousel-image-delete', [CarouselImageDeleteEvent::class, 'carouselImageDelete'])
        ->name('carousel-image-delete');

    Route::post('carousel-image-upload', [CarouselImageUploadEvent::class, 'carouselImageUpload'])
        ->name('carousel-image-upload');

});