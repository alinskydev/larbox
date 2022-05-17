<?php

use Illuminate\Support\Facades\Route;

use Modules\Information\Http\Public\Controllers\InformationSystemController;
use Modules\Information\Http\Public\Controllers\InformationLocalizationController;
use Modules\Information\Http\Public\Controllers\InformationEnumsController;
use Modules\Information\Http\Public\Controllers\InformationStatisticsController;

Route::prefix('information')
    ->middleware('api')
    ->group(function () {
        Route::get('system/settings', [InformationSystemController::class, 'settings']);
        Route::get('system/languages', [InformationSystemController::class, 'languages']);

        Route::get('localization/messages/{type}', [InformationLocalizationController::class, 'messages'])
            ->whereIn('type', ['android']);

        Route::get('enums/report', [InformationEnumsController::class, 'report']);
        Route::get('enums/task', [InformationEnumsController::class, 'task']);
        Route::get('enums/user', [InformationEnumsController::class, 'user']);

        Route::get('statistics/countings', [InformationStatisticsController::class, 'countings'])
            ->middleware('auth.basic.once', 'role:agent', 'api');
    });
