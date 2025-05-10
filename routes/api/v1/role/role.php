<?php

use App\Http\Controllers\Api\V1\Role\RoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('/role')->controller(RoleController::class)->group(function () {
    Route::get('/', 'index');
});
