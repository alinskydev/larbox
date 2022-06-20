<?php

use Illuminate\Support\Facades\Route;

use Http\Common\Information\Controllers\SystemController;
use Http\Common\Information\Controllers\EnumsController;

Route::prefix('information')
    ->group(function () {
        Route::get('enums', [EnumsController::class, 'index']);
        Route::get('system', [SystemController::class, 'index']);
    });
