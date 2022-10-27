<?php

use Illuminate\Support\Facades\Route;

use Http\Website\Box\Controllers\BrandController;
use Http\Website\Box\Controllers\CategoryController;

Route::prefix('box')
    ->middleware(['auth.basic.once'])
    ->group(function () {
        Route::apiResource('brand', BrandController::class)->except(['deleteAll', 'restore', 'restoreAll']);

        Route::get('category-tree', [CategoryController::class, 'tree'])->name('category.tree');
        Route::get('category-show/{fullSlug}', [CategoryController::class, 'showByFullSlug'])
            ->where('fullSlug', '(.*)')
            ->name('category.show');

        Route::apiResource('category', CategoryController::class)->only(['index']);
    });
