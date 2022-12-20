<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\User\Controllers\UserController;
use Http\Admin\User\Controllers\RoleController;
use Http\Admin\User\Controllers\NotificationController;
use Http\Admin\User\Controllers\ProfileController;

Route::prefix('user')
    ->group(function () {
        Route::prefix('notification')
            ->group(function () {
                Route::apiResource('', NotificationController::class)->only(['index', 'show', 'create']);
                Route::patch('see-all', [NotificationController::class, 'seeAll'])->name('seeAll');
            });

        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show'])->name('show');
                Route::put('', [ProfileController::class, 'update'])->name('update');
            });

        Route::apiResource('role', RoleController::class)->except(['deleteAll', 'restore', 'restoreAll']);
        Route::apiResource('user', UserController::class)->except(['deleteAll', 'restoreAll']);
    });
