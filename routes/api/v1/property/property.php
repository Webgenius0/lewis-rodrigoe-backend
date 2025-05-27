<?php

use App\Http\Controllers\Api\V1\Property\Job\PropertyJonController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use App\Http\Controllers\Api\V1\Property\Type\PropertyTypeController;
use Illuminate\Support\Facades\Route;

/**
 * property
 */
Route::prefix('/property')->middleware('auth:api')
->controller(PropertyController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/dropdown', 'userDropdown');
    Route::post('/price', 'propertyCalculation');
});

/**
 * property-job
 */
Route::prefix('/property-job')
->controller(PropertyJonController::class)->group(function () {
    Route::get('/{status}', 'index')->where('status','active|inactive|pending|ongoing|completed|assigned');
    Route::post('/', 'store');
    Route::get('/{propertyJob}/details', 'show');
});

Route::prefix('/property-type')
->controller(PropertyTypeController::class)->group(function () {
    Route::get('/', 'index');
});
