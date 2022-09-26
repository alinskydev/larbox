<?php

use Illuminate\Support\Facades\Route;

use Http\Common\System\Controllers\SystemController;

Route::prefix('system')
    ->group(function () {
        Route::get('information', [SystemController::class, 'information'])->name('information');
        Route::get('enums', [SystemController::class, 'enums'])->name('enums');
    });
