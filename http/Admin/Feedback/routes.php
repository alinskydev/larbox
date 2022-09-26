<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Feedback\Controllers\CallbackController;
use App\Http\Controllers\Actions\SetValueAction;
use Modules\Feedback\Enums\FeedbackEnums;

use Modules\Feedback\Models\Callback;

Route::prefix('feedback')
    ->group(function () {
        Route::prefix('callback')
            ->group(function () {
                Route::model('callback', Callback::class);

                Route::apiResource('', CallbackController::class)->except(['create', 'update']);

                Route::patch('{callback}/set-status/{value}', SetValueAction::class)
                    ->whereIn('value', array_keys(FeedbackEnums::statuses()))
                    ->setBindingFields(['field' => 'status'])
                    ->name('setStatus');
            });
    });
