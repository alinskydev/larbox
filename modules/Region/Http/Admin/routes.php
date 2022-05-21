<?php

use Illuminate\Support\Facades\Route;

use Modules\Region\Http\Admin\Controllers\RegionCountryController;
use Modules\Region\Http\Admin\Controllers\RegionController;
use Modules\Region\Http\Admin\Controllers\RegionCityController;
use App\Http\Controllers\Actions\RestoreAction;

use Modules\Region\Models\RegionCountry;
use Modules\Region\Models\Region;
use Modules\Region\Models\RegionCity;

Route::prefix('region')
    ->where([
        'country' => '[0-9]+',
        'region' => '[0-9]+',
        'city' => '[0-9]+',
    ])
    ->group(function () {
        Route::apiResource('country', RegionCountryController::class)->parameter('country', 'model');
        Route::apiResource('region', RegionController::class)->parameter('region', 'model');
        Route::apiResource('city', RegionCityController::class)->parameter('city', 'model');

        Route::delete('country/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => RegionCountry::class]);
        Route::delete('region/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => Region::class]);
        Route::delete('city/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => RegionCity::class]);
    });
