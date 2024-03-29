<?php

use Illuminate\Support\Facades\Route;

use Http\Website\Feedback\Controllers\FeedbackController;

Route::prefix('feedback')
    ->group(function () {
        Route::post('callback', [FeedbackController::class, 'callback'])->name('callback');
    });
