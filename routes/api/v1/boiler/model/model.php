<?php

use App\Http\Controllers\Api\V1\Boiler\Model\BoilerModelController;
use Illuminate\Support\Facades\Route;

Route::prefix('/boiler-model')->controller(BoilerModelController::class)->group(function () {
    Route::get('/', 'index');
});
