<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Policy\TermsOfUseController;

Route::get('/terms-of-use',[TermsOfUseController::class, 'termsOfUse'])->name('terms-of-use');