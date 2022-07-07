<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Storage\Controllers\UploadController;
use Http\Admin\Storage\Controllers\CacheController;

Route::prefix('storage')->group(function () {
    Route::prefix('upload')->group(function () {
        Route::post('file', [UploadController::class, 'file']);
        Route::post('media', [UploadController::class, 'media']);
    });

    Route::delete('cache/delete-thumbs', [CacheController::class, 'deleteThumbs']);
});
