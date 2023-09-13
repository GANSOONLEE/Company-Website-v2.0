<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Valid\CheckEmailDuplication;
use App\Domains\Auth\Events\RegisterEvent;

Route::post('register/valid', [CheckEmailDuplication::class ,'checkEmailDuplication'])->name('register.valid');

Route::post('register/post', [RegisterEvent::class ,'register'])->name('register.post');
