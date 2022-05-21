<?php

use Illuminate\Support\Facades\Route;

use Modules\Auth\Http\Public\Controllers\AuthController;
use Modules\Auth\Http\Public\Controllers\ResetPasswordController;

Route::prefix('auth')
    ->middleware('api')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::prefix('reset-password')
            ->group(function () {
                Route::post('send-email', [ResetPasswordController::class, 'sendEmail']);
                Route::post('verify-code', [ResetPasswordController::class, 'verifyCode']);
                Route::post('set-new-password', [ResetPasswordController::class, 'setNewPassword']);
            });
    });
