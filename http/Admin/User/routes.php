<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\User\Controllers\UserController;
use Http\Admin\User\Controllers\RoleController;
use Http\Admin\User\Controllers\NotificationController;
use Http\Admin\User\Controllers\ProfileController;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\User\Models\Profile;

Route::prefix('user')
    ->group(function () {
        Route::prefix('user')
            ->group(function () {
                Route::model('profile', Profile::class);

                Route::apiResource('', UserController::class)->except(['destroyAll', 'restoreAll']);

                Route::delete('{profile}/delete-file/{field}/{index?}', DeleteFileAction::class)
                    ->whereIn('field', ['image'])
                    ->name('deleteFile');
            });

        Route::apiResource('role', RoleController::class)->except(['destroyAll', 'restore', 'restoreAll']);

        Route::prefix('notification')
            ->group(function () {
                Route::apiResource('', NotificationController::class)->only(['index', 'show', 'store']);
                Route::patch('see-all', [NotificationController::class, 'seeAll'])->name('seeAll');
            });

        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show'])->name('show');
                Route::put('', [ProfileController::class, 'update'])->name('update');
            });
    });
