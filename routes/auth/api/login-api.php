<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Events\LoginEvent;

Route::post('login/post', [LoginEvent::class ,'login'])->name('login.post');
