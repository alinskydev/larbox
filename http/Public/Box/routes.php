<?php

use Illuminate\Support\Facades\Route;

use Http\Public\Box\Controllers\BrandController;

Route::prefix('box')
    ->middleware(['auth.basic.once'])
    ->group(function () {
        Route::apiResource('brand', BrandController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    });
