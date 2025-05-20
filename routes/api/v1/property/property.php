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
});

/**
 * property-job
 */
Route::prefix('/property-job')->middleware('auth:api')
->controller(PropertyJonController::class)->group(function () {
    Route::post('/', 'store');
});

Route::prefix('/property-type')->middleware('auth:api')
->controller(PropertyTypeController::class)->group(function () {
    Route::get('/', 'index');
});
