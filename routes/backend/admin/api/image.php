<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Image\Events\CarouselImageUpdateEvent;

Route::group(['prefix' => 'image', 'as' => 'image.'] , function(){

    // POST
    Route::post('carousel-image-update', [CarouselImageUpdateEvent::class, 'carouselImageUpdate'])
        ->name('carousel-image-update');

});