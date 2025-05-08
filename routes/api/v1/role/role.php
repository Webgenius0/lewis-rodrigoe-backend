<?php

use App\Http\Controllers\Api\V1\Role\RoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1/role')->controller(RoleController::class)->group(function () {
    Route::get('/', 'index');
});
