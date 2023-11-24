<?php

// Laravel Support
use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\Backend\Admin\ReportBugController;




Route::get('report-bug', [ReportBugController::class, 'reportBug'])
    ->name('report-bug');
