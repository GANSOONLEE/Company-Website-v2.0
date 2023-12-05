<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\User\UserDataController;
use App\Http\Controllers\Backend\User\UserDataPostController;
use App\Http\Controllers\Backend\User\UserChangePasswordPostController;

Route::group(['prefix' => 'data', 'as' => 'data.'], function(){
    
    // GET
    Route::get('/', [UserDataController::class, 'userData'])->name('user');

    // POST
    Route::post('/post', [UserDataPostController::class, 'userPostData'])->name('user-post');

    // POST
    Route::post('/change-password/post', [UserChangePasswordPostController::class, 'userChangePassword'])->name('change-password-post');

});
