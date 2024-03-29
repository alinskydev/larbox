<?php

use Illuminate\Support\Facades\Route;

use Http\Common\Auth\Controllers\AuthController;
use Http\Common\Auth\Controllers\ResetPasswordController;

Route::prefix('auth')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [AuthController::class, 'register'])->name('register');

        Route::prefix('reset-password')
            ->group(function () {
                Route::post('send-code', [ResetPasswordController::class, 'sendCode'])
                    ->middleware('throttle:3')
                    ->name('send-code');

                Route::post('verify-code', [ResetPasswordController::class, 'verifyCode'])->name('verify-code');
                Route::post('complete', [ResetPasswordController::class, 'complete'])->name('complete');
            });
    });
