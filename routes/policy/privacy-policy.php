<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Policy\PrivacyPolicyController;

Route::get('/privacy-policy',[PrivacyPolicyController::class, 'privacyPolicy'])->name('privacy-policy');