<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ContactController;

Route::get('/contact-us',[ContactController::class, 'contact'])->name('contact');