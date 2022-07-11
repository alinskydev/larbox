<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Page\Controllers\PageController;

Route::prefix('page')
    ->group(function () {
        Route::get('{name}', [PageController::class, 'show']);
        Route::patch('{name}', [PageController::class, 'update']);
    });
