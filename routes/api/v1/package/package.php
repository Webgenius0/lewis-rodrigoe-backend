<?php
use App\Http\Controllers\Api\V1\Package\PackageController;
use Illuminate\Support\Facades\Route;

Route::prefix('package')->controller(PackageController::class)->group(function () {
    Route::get('/{type}', 'index')->where('type', 'general|landload');
});
