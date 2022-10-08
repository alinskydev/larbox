<?php

use Illuminate\Support\Facades\Route;

use Http\Client\User\Controllers\ProfileController;

Route::prefix('user')
    ->middleware(['auth.basic.once'])
    ->group(function () {
        Route::prefix('profile')
            ->group(function () {
                Route::get('', [ProfileController::class, 'show'])->name('show');
                Route::put('', [ProfileController::class, 'update'])->name('update');
            });
    });
