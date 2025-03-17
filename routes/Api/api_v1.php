<?php

use App\Http\Controllers\Api\V1\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProvinceController;
use App\Http\Controllers\Api\V1\SubdistrictController;
use App\Http\Controllers\Api\V1\VillageController;

Route::controller(ProvinceController::class)
    ->prefix('provinces')
    ->group(function () {
        Route::get('list', 'list');
    });

Route::controller(CityController::class)
    ->prefix('cities')
    ->group(function () {
        Route::get('list/{province_code?}', 'list');
    });

Route::controller(SubdistrictController::class)
    ->prefix('subdistricts')
    ->group(function () {
        Route::get('list/{city_code?}', 'list');
    });

Route::controller(VillageController::class)
    ->prefix('villages')
    ->group(function () {
        Route::get('list/{subdistrict_code?}', 'list');
    });
