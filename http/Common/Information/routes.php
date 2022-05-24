<?php

use Illuminate\Support\Facades\Route;

use Http\Common\Information\Controllers\SystemController;
use Http\Common\Information\Controllers\EnumsController;
use Http\Common\Information\Controllers\LocalizationController;

Route::prefix('information')
    ->middleware('api')
    ->group(function () {
        Route::get('system/settings', [SystemController::class, 'settings']);
        Route::get('system/languages', [SystemController::class, 'languages']);

        Route::get('enums/user', [EnumsController::class, 'user']);

        Route::get('localization/messages/{type}', [LocalizationController::class, 'messages'])
            ->whereIn('type', ['android']);
    });
