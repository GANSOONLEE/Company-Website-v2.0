<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\User\UserDataController;
use App\Http\Controllers\Backend\User\UserDataPostController;

Route::group(['prefix' => 'data', 'as' => 'data.'], function(){
    
    // GET
    Route::get('/', [UserDataController::class, 'userData'])->name('user');

    // POST
    Route::post('/post', [UserDataPostController::class, 'userPostData'])->name('user-post');

});
