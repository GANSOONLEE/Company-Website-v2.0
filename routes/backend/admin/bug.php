<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Bug\Events\BugReportEvent;

Route::group(['prefix' => 'bug', 'as' => 'bug.'], function(){

    Route::post('post', [BugReportEvent::class, 'bugReport'])
        ->name('bug-report.post');

});