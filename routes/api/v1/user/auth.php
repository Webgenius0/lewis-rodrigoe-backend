<?php

use App\Http\Controllers\Api\V1\AuthProfile\AuthProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('/auth-user')->controller(AuthProfileController::class)->group(function () {
    Route::get('/', 'show');
    Route::post('/','update');
    Route::delete('/', 'destory');
    Route::get('/dashboard', 'dashboard');
});
