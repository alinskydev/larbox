<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Section\Controllers\SectionController;

Route::prefix('section')
    ->group(function () {
        Route::get('{name}', [SectionController::class, 'show']);
        Route::put('{name}', [SectionController::class, 'update']);
    });
