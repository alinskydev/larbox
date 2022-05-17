<?php

use Illuminate\Support\Facades\Route;

use Modules\User\Http\Admin\Controllers\UserController;
use Modules\User\Http\Admin\Controllers\UserMessageController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\DeleteFileAction;

use Modules\User\Models\User;
use Modules\User\Models\UserMessage;

Route::prefix('user')
    ->where([
        'user' => '[0-9]+',
        'message' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('user', User::class);
        Route::model('message', UserMessage::class);

        Route::apiResource('user', UserController::class);
        Route::apiResource('message', UserMessageController::class)->except(['update']);

        Route::delete('user/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => User::class]);

        Route::delete('message/{message}/delete-file/{field}/{index?}', DeleteFileAction::class)->whereIn('field', ['files_list']);
    });
