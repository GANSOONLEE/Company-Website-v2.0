<?php

use Illuminate\Support\Facades\Route;
use App\Domains\GasOil\Http\Controllers\GasOilController;

Route::group(["prefix" => "gas-oil", "as" => "gas-oil."], function () {

    // Return [View]
    Route::get('/', [GasOilController::class, 'index'])->name('index');

});