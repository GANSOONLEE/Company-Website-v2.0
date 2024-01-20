<?php

use Illuminate\Support\Facades\Route;
use App\Domains\GasOil\Http\Controllers\GasOilController;

Route::group(["prefix" => "gas-oil", "as" => "gas-oil."], function () {

    // Return [View]
    Route::get('/', [GasOilController::class, 'index'])->name('index');

    // Store Data
    Route::post('/', [GasOilController::class, 'store'])->name('store');

    // Patch Data
    Route::patch('/', [GasOilController::class, 'update'])->name('update');

    // Delete Data
    Route::delete('${id}', [GasOilController::class, 'destroy'])->name('destroy');

});