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
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/dropdown', 'userDropdown');
        Route::post('/price', 'propertyCalculation');
        Route::get('/{property}', 'show');
    });

/**
 * property-job
 */
Route::prefix('/property-job')
    ->controller(PropertyJonController::class)->group(function () {
        Route::get('/{status}', 'index')->where('status', 'all|active|inactive|pending|ongoing|completed|assigned');
        Route::post('/', 'store');

        Route::patch('{propertyJob}/status/{status}', 'status')->where('status', 'active|inactive|ongoing|completed|assigned');

        Route::middleware('engineer')->group(function () {
            Route::get('/engineer/{status}', 'engineerIndex')->where('status', 'active|inactive|ongoing|completed|assigned');
            Route::get('/engineer/pending', 'pendingIndex');
            Route::get('/{propertyJob}/details', 'show');
            Route::patch('/{propertyJob}/assign', 'assignEngineer');
        });
    });
