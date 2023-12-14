<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Http\Controllers\LoginController;
use App\Domains\Auth\Http\Controllers\RegisterController;
use App\Domains\Auth\Http\Controllers\PasswordController;

/** Process the login event and auth */
Route::group(['prefix' =>'login', 'as' =>'login.'], function()
{

    // Login
    Route::get('/', [LoginController::class, 'index'])
        ->name('index');

    // Store Login Inform 
    Route::post('/', [LoginController::class, 'store'])
        ->name('store');

});

/** Process the register event and validation email */
Route::group(['prefix' =>'register', 'as' =>'register.'], function()
{
    // Register
    Route::get('/', [RegisterController::class, 'index'])
        ->name('index');

    // Store Login Inform 
    Route::post('/', [RegisterController::class, 'store'])
        ->name('store');
});

/** Process the password reset and change password */
Route::group(['prefix' =>'password', 'as' =>'password.'], function()
{
    // Change Password
    Route::patch('/', [PasswordController::class, 'change'])
        ->name('change');

    // Reset Password
    Route::patch('/', [PasswordController::class, 'reset'])
        ->name('reset');
});

/** Process the logout event */
Route::get('logout', [LoginController::class, 'logout'])
    ->name('logout');