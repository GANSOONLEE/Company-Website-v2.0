<?php

use Illuminate\Support\Facades\Route;
use App\Domains\category\Http\Controllers\categoryTitleController;

Route::group(['prefix' => 'categoryTitle', 'as' => 'categoryTitle.'], function() {

    // [Post] Record
    Route::post('store', [categoryTitleController::class, 'store'])
        ->name('store');

    // [Patch] Record
    Route::patch('/store/{id}', [categoryTitleController::class, 'update'])
        ->name('update');

    // [Delete] Record
    Route::delete('/store/{id}', [categoryTitleController::class, 'delete'])
        ->name('delete');

});