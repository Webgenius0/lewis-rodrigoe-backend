<?php

use App\Http\Controllers\Api\V1\Boiler\Type\BoilerTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/boiler-type')->controller(BoilerTypeController::class)->group(function () {
    Route::get('/', 'index');
});
