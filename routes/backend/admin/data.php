<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Data\Http\Controllers\DataController;

Route::group(['prefix' => 'data', 'as' => 'data.'], function() {

    // Get [View] Record
    Route::get('record', [DataController::class, 'record'])
        ->name('record');

    // Get [View] Import
    Route::get('import', [DataController::class, 'import'])
        ->name('import');

    // Get [View] Export
    Route::get('export', [DataController::class, 'export'])
        ->name('export');
    
    // Import Table Data
    Route::post('importData', [DataController::class, 'importData'])
        ->name('import-data');
    
    // Export Table Data
    Route::post('exportData', [DataController::class, 'exportData'])
        ->name('export-data');

    // Search record and pass to [View] Record
    Route::get('search', [DataController::class, 'search'])
        ->name('record-search');

});