<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Box\Controllers\BrandController;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\Box\Models\Brand;

Route::prefix('box')
    ->where([
        'brand' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('brand', Brand::class);

        Route::apiResource('brand', BrandController::class);

        Route::delete('brand/{brand}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['file', 'files_list']);
    });
