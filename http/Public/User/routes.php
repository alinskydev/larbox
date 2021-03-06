<?php

use Illuminate\Support\Facades\Route;

use Http\Public\User\Controllers\ProfileController;

Route::prefix('user')
    ->group(function () {
        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show']);
                Route::patch('', [ProfileController::class, 'update']);
            });
    });
