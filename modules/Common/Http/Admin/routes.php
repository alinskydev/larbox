<?php

use Illuminate\Support\Facades\Route;

use Modules\Common\Http\Admin\Controllers\FileController;
use Modules\Common\Http\Admin\Controllers\CacheController;

Route::prefix('common')->group(function () {
    Route::post('file/upload', [FileController::class, 'upload']);
    Route::delete('cache/delete-thumbs', [CacheController::class, 'deleteThumbs']);
});
