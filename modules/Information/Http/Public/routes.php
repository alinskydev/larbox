<?php

use Illuminate\Support\Facades\Route;

use Modules\Information\Http\Public\Controllers\InformationSystemController;
use Modules\Information\Http\Public\Controllers\InformationEnumsController;
use Modules\Information\Http\Public\Controllers\InformationLocalizationController;

Route::prefix('information')
    ->middleware('api')
    ->group(function () {
        Route::get('system/settings', [InformationSystemController::class, 'settings']);
        Route::get('system/languages', [InformationSystemController::class, 'languages']);

        Route::get('enums/user', [InformationEnumsController::class, 'user']);

        Route::get('localization/messages/{type}', [InformationLocalizationController::class, 'messages'])
            ->whereIn('type', ['android']);
    });
