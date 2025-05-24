<?php


use App\Http\Controllers\Api\V1\Message\MessageController;
use Illuminate\Support\Facades\Route;


Route::controller(MessageController::class)->group(function () {
    Route::post('/messages', 'send');
    Route::get('/messages/{user}', 'conversation');
});
