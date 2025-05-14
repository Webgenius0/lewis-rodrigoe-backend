<?php

use App\Http\Controllers\Api\V1\Property\Job\PropertyJonController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use Illuminate\Support\Facades\Route;

/**
 * property
 */
Route::prefix('/property')->middleware('auth:api')
->controller(PropertyController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/dropdown', 'userDropdown');
});

/**
 * property-job
 */
Route::prefix('/property-job')->middleware('auth:api')
->controller(PropertyJonController::class)->group(function () {
    Route::post('/', 'store');
});
