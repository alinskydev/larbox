<?php

use Illuminate\Support\Facades\Route;

use Modules\Shop\Http\Admin\Controllers\ShopCompanyController;
use Modules\Shop\Http\Admin\Controllers\ShopSupplierController;
use Modules\Shop\Http\Admin\Controllers\ShopContactController;
use Modules\Shop\Http\Admin\Controllers\ShopController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Shop\Models\ShopCompany;
use Modules\Shop\Models\ShopSupplier;
use Modules\Shop\Models\ShopContact;
use Modules\Shop\Models\Shop;

Route::prefix('shop')
    ->where([
        'company' => '[0-9]+',
        'supplier' => '[0-9]+',
        'contact' => '[0-9]+',
        'shop' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('company', ShopCompany::class);
        Route::model('supplier', ShopSupplier::class);
        Route::model('contact', ShopContact::class);
        Route::model('shop', Shop::class);

        Route::apiResource('company', ShopCompanyController::class);
        Route::apiResource('supplier', ShopSupplierController::class);
        Route::apiResource('contact', ShopContactController::class);
        Route::apiResource('shop', ShopController::class);

        Route::delete('company/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ShopCompany::class]);
        Route::delete('supplier/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ShopSupplier::class]);
        Route::delete('contact/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ShopContact::class]);
        Route::delete('shop/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => Shop::class]);

        Route::post('supplier/{supplier}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);

        Route::post('contact/{contact}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);

        Route::post('shop/{shop}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);
    });
