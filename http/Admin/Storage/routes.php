<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Storage\Controllers\UploadController;

Route::prefix('storage')->group(function () {
    Route::prefix('upload')->group(function () {
        Route::post('file', [UploadController::class, 'file'])->name('file');
        Route::post('media', [UploadController::class, 'media'])->name('media');
    });
});
