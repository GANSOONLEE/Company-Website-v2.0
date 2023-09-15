<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Brand\Events\BrandUpdateEvent;
use App\Domains\Brand\Events\BrandCreateEvent;

// Update
Route::post('brand/update-brand', [BrandUpdateEvent::class, 'brandUpdate'])->name('brand.update');
Route::post('brand/create-brand', [BrandCreateEvent::class, 'brandCreate'])->name('brand.create');