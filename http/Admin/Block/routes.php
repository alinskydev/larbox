<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Block\Controllers\PageController;

Route::prefix('block')
    ->group(function () {
        Route::prefix('page')
            ->group(function () {
                Route::get('{name}', [PageController::class, 'show']);
                Route::patch('{name}', [PageController::class, 'update']);
            });
    });
