<?php
use App\Http\Controllers\Api\V1\OnlineHoiur\OnlineHourController;
use Illuminate\Support\Facades\Route;


Route::prefix('online-hour')->controller(OnlineHourController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/pare-user', 'pareUser');
});
