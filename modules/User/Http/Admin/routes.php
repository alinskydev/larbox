<?php

use Illuminate\Support\Facades\Route;

use Modules\User\Http\Admin\Controllers\UserController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\User\Models\User;
use Modules\User\Models\UserProfile;

Route::prefix('user')
    ->where([
        'user' => '[0-9]+',
        'profile' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('user', User::class);
        Route::model('profile', UserProfile::class);

        Route::apiResource('user', UserController::class);

        Route::delete('user/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => User::class]);

        Route::delete('user/{profile}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image']);
    });
