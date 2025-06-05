<?php


use App\Http\Controllers\Api\V1\Card\CardController;
use Illuminate\Support\Facades\Route;

Route::prefix('/card')->controller(CardController::class)->group(function () {
    Route::post('/', 'store');
});
