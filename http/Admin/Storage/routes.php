<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Storage\Controllers\UploadController;
use Http\Admin\Storage\Controllers\CacheController;

Route::prefix('storage')->group(function () {
    Route::prefix('cache')->group(function () {
        Route::delete('delete-thumbs', [CacheController::class, 'deleteThumbs'])->name('deleteThumbs');
    });

    Route::prefix('upload')->group(function () {
        Route::post('file', [UploadController::class, 'file'])->name('file');
        Route::post('media', [UploadController::class, 'media'])->name('media');
    });
});
