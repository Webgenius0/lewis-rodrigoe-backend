<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * V1 API Routes:
 */
Route::prefix('/v1')->group(function () {
    require 'v1/auth/auth.php';          // All Auth routes
    require 'v1/role/role.php';          // All Auth routes
    require 'v1/service/service.php';    // All Auth routes
    require 'v1/property/property.php';  // All Auth routes
    require 'v1/address/country/country.php';  // All Auth routes
    require 'v1/address/state/state.php';  // All Auth routes
    require 'v1/address/city/city.php';  // All Auth routes
    require 'v1/address/zip/zip.php';  // All Auth routes
});
