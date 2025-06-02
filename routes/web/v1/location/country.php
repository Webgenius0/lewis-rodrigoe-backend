<?php

use App\Http\Controllers\Web\V1\Location\CountryController;
use Illuminate\Support\Facades\Route;

Route::prefix('location/country')->name('v1.location.country.')->controller(CountryController::class)
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{country:slug}', 'edit')->name('edit');
        Route::put('/update/{country:slug}', 'update')->name('update');
        Route::delete('/destroy/{country:slug}', 'destroy')->name('destroy');
    })->middleware(['auth', 'verified']);
