<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\User\Controllers\UserController;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\User\Models\Profile;

Route::prefix('user')
    ->where([
        'user' => '[0-9]+',
        'profile' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('profile', Profile::class);

        Route::apiResource('user', UserController::class);

        Route::delete('user/{profile}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['image']);
    });
