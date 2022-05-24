<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Storage\Controllers\FileController;
use Http\Admin\Storage\Controllers\CacheController;

Route::prefix('storage')->group(function () {
    Route::post('file/upload', [FileController::class, 'upload']);
    Route::delete('cache/delete-thumbs', [CacheController::class, 'deleteThumbs']);
});
