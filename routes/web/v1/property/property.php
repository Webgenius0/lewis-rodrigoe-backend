<?php

use App\Http\Controllers\Web\V1\Property\PropertyController;
use Illuminate\Support\Facades\Route;

Route::prefix('property')->name('v1.property.')->controller(PropertyController::class)
->group(function (): void {
    Route::get('/', 'index')->name('index');
})->middleware(['auth', 'verified']);
