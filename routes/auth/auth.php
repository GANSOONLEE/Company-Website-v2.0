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
    Route::post('/', [LoginController::class, 'valid'])
        ->name('valid');

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
    Route::get('change', [PasswordController::class, 'change'])
        ->name('change');

    Route::patch('change', [PasswordController::class, 'update'])
        ->name('update');

    // Account Help
    Route::get('account-help', [PasswordController::class, 'help'])
        ->name('help');

    // Reset Password
    Route::post('reset', [PasswordController::class, 'reset'])
        ->name('reset');

    // Verify Password
    Route::get('verify', [PasswordController::class, 'verify'])
        ->name('verify');
        
    // Verify Password
    Route::get('password-reset', [PasswordController::class, 'resetPassword'])
        ->name('password-reset');

    Route::patch('renew', [PasswordController::class, 'renew'])
        ->name('renew');
});

/** Process the logout event */
Route::get('logout', [LoginController::class, 'logout'])
    ->name('logout');