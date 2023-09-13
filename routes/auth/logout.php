<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LogoutController;

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');