<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * V1 API Routes:
 */
Route::prefix('/v1')->group(function () {
    require 'v1/auth/auth.php';


    require 'v1/role/role.php';
    require 'v1/service/service.php';
    require 'v1/address/country/country.php';
    require 'v1/address/state/state.php';
    require 'v1/address/city/city.php';
    require 'v1/address/zip/zip.php';
    require 'v1/boiler/type/type.php';
    require 'v1/boiler/model/model.php';
    require 'v1/property/property-withoutauth.php';
    require 'v1/package/package.php';

    Route::middleware('auth:api')->group(function () {
        require 'v1/user/auth.php';
        require 'v1/online-hour/online-hour.php';
        require 'v1/message/message.php';
        require 'v1/property/property.php';
        require 'v1/card/card.php';
    });
});
