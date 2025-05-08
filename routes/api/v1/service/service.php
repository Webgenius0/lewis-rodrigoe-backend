<?php

use App\Http\Controllers\Api\V1\Service\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/service')->controller(ServiceController::class)->group(function () {
    Route::get('/', 'index');
});
