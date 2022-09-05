<?php

use Illuminate\Support\Facades\Route;

use Http\Common\Auth\Controllers\AuthController;
use Http\Common\Auth\Controllers\ResetPasswordController;

Route::prefix('auth')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::prefix('reset-password')
            ->group(function () {
                Route::post('send-code', [ResetPasswordController::class, 'sendCode']);
                Route::post('verify-code', [ResetPasswordController::class, 'verifyCode']);
                Route::post('complete', [ResetPasswordController::class, 'complete']);
            });
    });
