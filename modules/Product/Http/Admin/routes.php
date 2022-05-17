<?php

use Illuminate\Support\Facades\Route;

use Modules\Product\Http\Admin\Controllers\ProductBrandController;
use Modules\Product\Http\Admin\Controllers\ProductCategoryController;
use Modules\Product\Http\Admin\Controllers\ProductSpecificationController;
use Modules\Product\Http\Admin\Controllers\ProductController;
use Modules\Product\Http\Admin\Controllers\ProductVariationController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\DeleteFileAction;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductSpecification;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;

Route::prefix('product')
    ->where([
        'brand' => '[0-9]+',
        'category' => '[0-9]+',
        'specification' => '[0-9]+',
        'product' => '[0-9]+',
        'variation' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('brand', ProductBrand::class);
        Route::model('category', ProductCategory::class);
        Route::model('specification', ProductSpecification::class);
        Route::model('product', Product::class);
        Route::model('variation', ProductVariation::class);

        Route::apiResource('brand', ProductBrandController::class);
        Route::apiResource('category', ProductCategoryController::class);
        Route::apiResource('specification', ProductSpecificationController::class);
        Route::apiResource('product', ProductController::class);
        Route::apiResource('variation', ProductVariationController::class)->except(['index']);

        Route::delete('brand/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ProductBrand::class]);
        Route::delete('category/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ProductCategory::class]);
        Route::delete('specification/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ProductSpecification::class]);
        Route::delete('product/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => Product::class]);
        Route::delete('variation/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => ProductVariation::class]);

        Route::delete('product/{product}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['images_list']);
        Route::delete('variation/{variation}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['images_list']);

        Route::post('brand/{brand}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);

        Route::post('product/{product}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);
    });
