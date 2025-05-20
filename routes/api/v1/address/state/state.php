<?php

use App\Http\Controllers\Api\V1\Address\State\StateController;
use Illuminate\Support\Facades\Route;

Route::prefix('/country/{country}/state')->controller(StateController::class)->group(function () {
    Route::get('/', 'index');
});
