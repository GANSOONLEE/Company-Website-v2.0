<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Cart\Events\UpdateUserCartEvent;

Route::post('cart/update', [UpdateUserCartEvent::class, 'updateUserCart'])->name('cart-update');