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
                Route::patch('{pk}/set-active/{value}', SetValueAction::class)
                    ->whereIn('value', [0, 1])
                    ->setBindingFields([
                        'model' => fn ($pk) => Brand::query()->findOrFail($pk),
                        'field' => 'is_active',
                    ])
                    ->name('set-active');

                Route::apiResource('', BrandController::class);
            });

        Route::prefix('category')
            ->group(function () {
                Route::get('tree', [CategoryController::class, 'tree'])->name('tree');
                Route::patch('move', [CategoryController::class, 'move'])->name('move');

                Route::apiResource('', CategoryController::class)->except(['deleteMultiple', 'restoreMultiple']);
            });


        Route::apiResource('tag', TagController::class);
    });
