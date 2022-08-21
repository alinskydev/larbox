<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Box\Controllers\BoxController;
use Http\Admin\Box\Controllers\BrandController;
use Http\Admin\Box\Controllers\TagController;
use App\Http\Controllers\Actions\DeleteFileAction;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;

Route::prefix('box')
    ->group(function () {
        Route::apiResource('box', BoxController::class);
        Route::apiResource('brand', BrandController::class);
        Route::apiResource('tag', TagController::class);

        Route::model('box', Box::class);
        Route::model('brand', Brand::class);

        Route::delete('box/{box}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image', 'images_list']);
        Route::delete('brand/{brand}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['file', 'files_list']);

        Route::patch('brand/{brand}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);
    });
