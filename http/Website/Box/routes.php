<?php

use Illuminate\Support\Facades\Route;

use Http\Website\Box\Controllers\BrandController;

Route::prefix('box')
    ->middleware(['auth.basic.once'])
    ->group(function () {
        Route::apiResource('brand', BrandController::class)->except(['deleteAll', 'restore', 'restoreAll']);
    });
