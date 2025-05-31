<?php

use App\Http\Controllers\Web\V1\User\EngineerController;
use Illuminate\Support\Facades\Route;

Route::prefix('user/engineer')->name('v1.user.engineer.')->controller(EngineerController::class)
->group(function (): void {
    Route::get('/', 'index')->name('index');
})->middleware(['auth', 'verified']);
