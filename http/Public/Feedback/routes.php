<?php

use Illuminate\Support\Facades\Route;

use Http\Public\Feedback\Controllers\FeedbackController;

Route::prefix('feedback')
    ->group(function () {
        Route::post('callback', [FeedbackController::class, 'callback'])->name('callback');
    });
