<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\User\Controllers\UserController;
use App\Http\Controllers\Actions\DeleteFileAction;
use Http\Admin\User\Controllers\ProfileController;
use Modules\User\Models\Profile;

Route::prefix('user')
    ->where([
        'profile' => '[0-9]+',
    ])
    ->group(function () {
        Route::apiResource('user', UserController::class);

        Route::model('profile', Profile::class);

        Route::delete('user/{profile}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image']);

        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show']);
                Route::post('', [ProfileController::class, 'update']);
            });
    });
