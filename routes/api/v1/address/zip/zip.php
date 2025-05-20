<?php

use App\Http\Controllers\Api\V1\Address\Zip\ZipController;
use Illuminate\Support\Facades\Route;

Route::prefix('/city/{city}/zip')->controller(ZipController::class)->group(function () {
    Route::get('/', 'index');
});
