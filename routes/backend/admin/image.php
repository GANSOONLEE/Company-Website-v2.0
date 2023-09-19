<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\Image\CarouselImageController;

Route::group(['prefix' => 'image', 'as' => 'image.'], function(){

    // GET
    Route::get('/carousel-image', [CarouselImageController::class, 'carouselImage'])->name('carousel-image');

});