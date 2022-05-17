<?php

use Illuminate\Support\Facades\Route;

use Modules\Product\Http\Public\Controllers\ProductBrandController;
use Modules\Product\Http\Public\Controllers\ProductController;
use Modules\Product\Http\Public\Controllers\ProductVariationController;

use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;

Route::prefix('product')
    ->middleware('auth.basic.once', 'role:agent', 'api')
    ->group(function () {
        Route::model('brand', ProductBrand::class);
        Route::model('product', Product::class);
        Route::model('variation', ProductVariation::class);

        Route::apiResource('brand', ProductBrandController::class)->only(['index', 'show', 'store']);
        Route::apiResource('product', ProductController::class)->only(['index', 'show', 'store']);
        Route::apiResource('variation', ProductVariationController::class)->only(['show', 'store']);
    });
