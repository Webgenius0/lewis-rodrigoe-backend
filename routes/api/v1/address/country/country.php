<?php

use App\Http\Controllers\Api\V1\Country\CountryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/country')->controller(CountryController::class)->group(function () {
    Route::get('/', 'index');
});
