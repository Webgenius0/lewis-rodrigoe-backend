<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
require 'v1/auth.php';

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.layouts.dashboard.index');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require 'v1/user/engineer.php';
    require 'v1/location/country.php';
    require 'v1/user/user.php';
    require 'v1/property/property.php';
    require 'v1/settings/mail.php';
});
