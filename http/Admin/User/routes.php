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
                Route::patch('see-all', [NotificationController::class, 'seeAll'])->name('see-all');
                Route::apiResource('', NotificationController::class)->only(['index', 'show', 'create']);
            });

        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show'])->name('show');
                Route::put('', [ProfileController::class, 'update'])->name('update');
            });

        Route::prefix('role')
            ->group(function () {
                Route::get('available-routes', [RoleController::class, 'availableRoutes'])->name('available-routes');
                Route::apiResource('', RoleController::class)->except(['restore', 'deleteMultiple', 'restoreMultiple']);
            });

        Route::apiResource('user', UserController::class)->except(['deleteMultiple', 'restoreMultiple']);
    });
