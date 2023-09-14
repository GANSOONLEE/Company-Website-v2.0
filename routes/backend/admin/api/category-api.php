<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Category\Events\CategoryUpdateEvent;
use App\Domains\Category\Events\CategoryCreateEvent;

// Update
Route::post('category/update-category', [CategoryUpdateEvent::class, 'categoryUpdate'])->name('category.update');
Route::post('category/create-category', [CategoryCreateEvent::class, 'categoryCreate'])->name('category.create');