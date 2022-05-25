<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Box\Controllers\BoxController;
use Http\Admin\Box\Controllers\BrandController;
use Http\Admin\Box\Controllers\TagController;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;

Route::prefix('box')
    ->where([
        'box' => '[0-9]+',
        'brand' => '[0-9]+',
        'tag' => '[0-9]+',
    ])
    ->group(function () {
        Route::apiResource('box', BoxController::class);
        Route::apiResource('brand', BrandController::class);
        Route::apiResource('tag', TagController::class);

        Route::model('box', Box::class);
        Route::model('brand', Brand::class);

        Route::delete('box/{box}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image', 'images_list']);
        Route::delete('brand/{brand}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['file', 'files_list']);
    });
