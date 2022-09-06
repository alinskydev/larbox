<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\User\Controllers\UserController;
use Http\Admin\User\Controllers\NotificationController;
use Http\Admin\User\Controllers\ProfileController;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\User\Models\Profile;

Route::prefix('user')
    ->group(function () {
        Route::apiResource('user', UserController::class)->except(['destroyAll', 'restoreAll']);

        Route::prefix('notification')
            ->group(function () {
                Route::apiResource('', NotificationController::class)->only(['index', 'show', 'store']);
                Route::put('see-all', [NotificationController::class, 'seeAll']);
            });

        Route::model('profile', Profile::class);

        Route::delete('user/{profile}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image']);

        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show']);
                Route::put('', [ProfileController::class, 'update']);
            });
    });
