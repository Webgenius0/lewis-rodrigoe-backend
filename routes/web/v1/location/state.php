<?php

use App\Http\Controllers\Web\V1\Location\StateController;
use Illuminate\Support\Facades\Route;

Route::prefix('/location/state')->name('location.state.')->controller(StateController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{state:slug}', 'edit')->name('edit');
    Route::put('/{state:slug}', 'update')->name('update');
    Route::delete('/{state:slug}', 'destroy')->name('destroy');
});
