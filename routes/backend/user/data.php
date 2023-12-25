<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Http\Controllers\UserController;
use App\Domains\Auth\Http\Controllers\PasswordController;

Route::group(['prefix' => 'data', 'as' => 'data.'], function(){
    
    Route::get('/', [UserController::class, 'profile'])
        ->name('index');

    Route::patch('/', [UserController::class, 'storeProfile'])
        ->name('storeProfile');

    Route::patch('change-password', [PasswordController::class, 'update'])
        ->name('update');

    Route::patch('reset-password', [PasswordController::class, 'reset'])
        ->name('reset');

    Route::delete('destroy', [UserController::class, 'destroy'])
        ->name('destroy');

});
