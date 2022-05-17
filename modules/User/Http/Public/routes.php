<?php

use Illuminate\Support\Facades\Route;

use Modules\User\Http\Public\Controllers\UserMessageController;

use Modules\User\Models\UserMessage;

Route::prefix('user')
    ->middleware('auth.basic.once', 'role:agent', 'api')
    ->group(function () {
        Route::model('message', UserMessage::class);

        Route::apiResource('message', UserMessageController::class)->only(['index', 'show', 'store']);
    });
