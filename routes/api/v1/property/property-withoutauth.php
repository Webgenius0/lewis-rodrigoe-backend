<?php


use App\Http\Controllers\Api\V1\Property\Type\PropertyTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/property-type')
    ->controller(PropertyTypeController::class)->group(function () {
        Route::get('/', 'index');
    });
