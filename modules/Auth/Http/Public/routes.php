<?php

use Illuminate\Support\Facades\Route;

use Modules\Auth\Http\Public\Controllers\AuthController;

Route::prefix('auth')
    ->middleware('api')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('reset-password-send-email', [AuthController::class, 'resetPasswordSendEmail']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });
