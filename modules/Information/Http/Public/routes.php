<?php

use Illuminate\Support\Facades\Route;

use Modules\Information\Http\Public\Controllers\SystemController;
use Modules\Information\Http\Public\Controllers\EnumsController;
use Modules\Information\Http\Public\Controllers\LocalizationController;

Route::prefix('information')
    ->middleware('api')
    ->group(function () {
        Route::get('system/settings', [SystemController::class, 'settings']);
        Route::get('system/languages', [SystemController::class, 'languages']);

        Route::get('enums/user', [EnumsController::class, 'user']);

        Route::get('localization/messages/{type}', [LocalizationController::class, 'messages'])
            ->whereIn('type', ['android']);
    });
