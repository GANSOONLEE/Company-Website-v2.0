<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Data\Http\Controllers\DataController;

Route::group(['prefix' => 'data', 'as' => 'data.'], function() {

    # TODO: DataController

    Route::get('record', [DataController::class, 'record'])
        ->name('record');

    Route::get('import', [DataController::class, 'import'])
        ->name('import');

    Route::get('export', [DataController::class, 'export'])
        ->name('export');

    // Operations

});