<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Domains\Auth\Events\ResetPasswordEvent;
use App\Domains\Auth\Events\UserResetPasswordEvent;
use App\Http\Controllers\Auth\UserResetPasswordController;

Route::get('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget-password');

Route::post('forget-password/send-email', [ResetPasswordEvent::class, 'resetPassword']);

Route::get('reset-password', [UserResetPasswordEvent::class, 'userResetPassword'])->name('reset.password');

Route::get('reset.password-user', [UserResetPasswordController::class, 'userResetPassword'])->name('reset.password-form');