<?php

use App\Http\Controllers\Web\V1\Location\CountryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/country')->name('country.')->controller(CountryController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/{country:slug}', 'edit')->name('edit');
    Route::put('/{country:slug}', 'update')->name('update');
    Route::delete('/{country:slug}', 'destroy')->name('destroy');
});
