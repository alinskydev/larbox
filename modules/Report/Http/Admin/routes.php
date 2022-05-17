<?php

use Illuminate\Support\Facades\Route;

use Modules\Report\Http\Admin\Controllers\ReportController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\Report\Models\Report;

Route::prefix('report')
    ->where([
        'report' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('report', Report::class);

        Route::apiResource('report', ReportController::class);

        Route::delete('report/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => Report::class]);

        Route::delete('report/{report}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['images_list']);
    });
