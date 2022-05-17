<?php

use Illuminate\Support\Facades\Route;

use Modules\Report\Http\Public\Controllers\ReportController;

use Modules\Report\Models\Report;

Route::prefix('report')
    ->middleware('auth.basic.once', 'role:agent', 'api')
    ->group(function () {
        Route::model('report', Report::class);

        Route::apiResource('report', ReportController::class)->only(['index', 'show', 'store']);
    });
