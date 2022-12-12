<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Box\Controllers\BoxController;
use Http\Admin\Box\Controllers\BrandController;
use Http\Admin\Box\Controllers\CategoryController;
use Http\Admin\Box\Controllers\TagController;
use App\Http\Controllers\Actions\DeleteFileAction;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;
use Modules\Box\Models\Variation;

Route::prefix('box')
    ->group(function () {
        Route::prefix('box')
            ->group(function () {
                Route::model('box', Box::class);

                Route::apiResource('', BoxController::class);

                Route::delete('{box}/delete-file/{field}/{index?}', DeleteFileAction::class)
                    ->whereIn('field', ['image', 'images_list'])
                    ->name('deleteFile');
            });

        Route::prefix('brand')
            ->group(function () {
                Route::model('brand', Brand::class);

                Route::apiResource('', BrandController::class);

                Route::delete('{brand}/delete-file/{field}/{index?}', DeleteFileAction::class)
                    ->whereIn('field', ['file', 'files_list'])
                    ->name('deleteFile');

                Route::patch('{brand}/set-active/{value}', SetValueAction::class)
                    ->whereIn('value', [0, 1])
                    ->setBindingFields(['field' => 'is_active'])
                    ->name('setActive');
            });

        Route::apiResource('category', CategoryController::class)->except(['deleteAll', 'restoreAll']);
        Route::get('category-tree', [CategoryController::class, 'tree'])->name('category.tree');
        Route::patch('category-move', [CategoryController::class, 'move'])->name('category.move');

        Route::apiResource('tag', TagController::class);

        Route::prefix('variation')
            ->group(function () {
                Route::model('variation', Variation::class);

                Route::delete('{variation}/delete-file/{field}/{index?}', DeleteFileAction::class)
                    ->whereIn('field', ['image'])
                    ->name('deleteFile');
            });
    });
