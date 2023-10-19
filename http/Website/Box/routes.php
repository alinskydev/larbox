<?php

use Illuminate\Support\Facades\Route;

use Http\Website\Box\Controllers\BrandController;
use Http\Website\Box\Controllers\CategoryController;

Route::prefix('box')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResource('brand', BrandController::class)->except(['restore', 'deleteMultiple', 'restoreMultiple']);

        Route::prefix('category')
            ->group(function () {
                Route::get('tree', [CategoryController::class, 'tree'])->name('tree');
                Route::get('{fullSlug}', [CategoryController::class, 'showByFullSlug'])
                    ->where('fullSlug', '(.*)')
                    ->name('show');

                Route::apiResource('', CategoryController::class)->only(['index']);
            });
    });
