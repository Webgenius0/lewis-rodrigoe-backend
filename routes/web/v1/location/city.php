<?php

use App\Http\Controllers\Web\V1\Location\CityController;
use Illuminate\Support\Facades\Route;

Route::prefix('location/city')->name('location.city.')->controller(CityController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{city:slug}', 'edit')->name('edit');
    Route::put('/{city:slug}', 'update')->name('update');
    Route::delete('/{city:slug}', 'destroy')->name('destroy');
});
