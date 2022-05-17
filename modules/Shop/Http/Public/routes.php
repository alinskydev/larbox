<?php

use Illuminate\Support\Facades\Route;

use Modules\Shop\Http\Public\Controllers\ShopSupplierController;
use Modules\Shop\Http\Public\Controllers\ShopContactController;
use Modules\Shop\Http\Public\Controllers\ShopController;

use Modules\Shop\Models\ShopSupplier;
use Modules\Shop\Models\ShopContact;
use Modules\Shop\Models\Shop;

Route::prefix('shop')
    ->middleware('auth.basic.once', 'role:agent', 'api')
    ->group(function () {
        Route::model('supplier', ShopSupplier::class);
        Route::model('contact', ShopContact::class);
        Route::model('shop', Shop::class);

        Route::apiResource('supplier', ShopSupplierController::class)->only(['index', 'show', 'store']);
        Route::apiResource('contact', ShopContactController::class)->only(['index', 'show', 'store']);
        Route::apiResource('shop', ShopController::class)->only(['index', 'show', 'store']);
    });
