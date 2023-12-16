<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;

Route::get('/', function() {
    return view('backend.admin.dashboard');
})->name('dashboard');