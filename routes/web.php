<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Notification\Services\RegisterVerifyService;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require_once app_path('Helpers/Global/SystemHelper.php');

/**
 * Frontend
 * Not need to login or get the authorize
 */

Route::group(['as' => 'frontend.', 'me'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});



/**
 * Backend Customer
 * Need to login to get the authorize
 */

Route::group(['prefix' => 'customer', 'as' => 'backend.customer.'], function () {
    includeRouteFiles(__DIR__ . '/backend/customer/');
});

/**
 * Backend Admin
 * Need to login to get the authorize
 */

Route::group(['prefix' => 'admin', 'as' => 'backend.admin.'], function () {
    includeRouteFiles(__DIR__ . '/backend/admin/');
});



/**
 * Policy
 * website information policy
 */

Route::group(['prefix' => 'policy', 'as' => 'policy.'], function () {
    includeRouteFiles(__DIR__ . '/policy/');
});



/**
 * Auth
 * provide authorize for local site
 */

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    includeRouteFiles(__DIR__ . '/auth/');
});



/**
 * Services
 * Provide services that require cross-site processing
 */

Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
    includeRouteFiles(__DIR__ . '/service/');
});