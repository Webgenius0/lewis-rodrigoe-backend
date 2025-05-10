<?php

use App\Http\Controllers\Api\V1\Property\PropertyController;
use Illuminate\Support\Facades\Route;


Route::prefix('/property')->controller(PropertyController::class)->group(function () {
    Route::post('/', 'store');
});
