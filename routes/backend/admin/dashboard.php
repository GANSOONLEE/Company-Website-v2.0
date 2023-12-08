<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;

Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');