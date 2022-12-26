<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Box\Controllers\BoxController;
use Http\Admin\Box\Controllers\BrandController;
use Http\Admin\Box\Controllers\CategoryController;
use Http\Admin\Box\Controllers\TagController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Box\Models\Brand;

Route::prefix('box')
    ->group(function () {
        Route::apiResource('box', BoxController::class);

        Route::prefix('brand')
            ->group(function () {
                Route::model('brand', Brand::class);

                Route::apiResource('', BrandController::class);

                Route::patch('{brand}/set-active/{value}', SetValueAction::class)
                    ->whereIn('value', [0, 1])
                    ->setBindingFields(['field' => 'is_active'])
                    ->name('setActive');
            });

        Route::apiResource('category', CategoryController::class)->except(['deleteMultiple', 'restoreMultiple']);
        Route::get('category-tree', [CategoryController::class, 'tree'])->name('category.tree');
        Route::patch('category-move', [CategoryController::class, 'move'])->name('category.move');

        Route::apiResource('tag', TagController::class);
    });
