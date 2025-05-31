<?php

use App\Http\Controllers\Web\V1\User\EngineerController;
use Illuminate\Support\Facades\Route;

Route::prefix('user/client')->name('v1.user.client.')->controller(EngineerController::class)
->group(function (): void {
    Route::get('/', 'index')->name('index');
})->middleware(['auth', 'verified']);
