<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Information\Controllers\EnumsController;

Route::prefix('information')
    ->group(function () {
        Route::get('enums', [EnumsController::class, 'index'])->name('enums.index');
    });
