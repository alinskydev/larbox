<?php

use Illuminate\Support\Facades\Route;

use Http\Public\User\Controllers\ProfileController;

Route::prefix('user')
    ->middleware(['auth.basic.once'])
    ->group(function () {
        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show']);
                Route::put('', [ProfileController::class, 'update']);
            });
    });
