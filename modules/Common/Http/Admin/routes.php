<?php

use Illuminate\Support\Facades\Route;

use Modules\Common\Http\Admin\Controllers\CommonFileController;
use Modules\Common\Http\Admin\Controllers\CommonCacheController;

Route::prefix('common')->group(function () {
    Route::post('file/upload', [CommonFileController::class, 'upload']);
    Route::delete('cache/delete-thumbs', [CommonCacheController::class, 'deleteThumbs']);
});
