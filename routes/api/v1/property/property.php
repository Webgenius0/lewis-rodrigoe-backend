<?php

use App\Http\Controllers\Api\V1\Property\PropertyController;
use Illuminate\Support\Facades\Route;


Route::prefix('/property')->middleware('auth:api')->controller(PropertyController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/dropdown', 'userDropdown');
});
