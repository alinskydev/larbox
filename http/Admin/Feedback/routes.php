<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\Feedback\Controllers\CallbackController;
use App\Http\Controllers\Actions\SetValueAction;
use Modules\Feedback\Enums\FeedbackStatusEnum;
use Modules\Feedback\Models\Callback;

Route::prefix('feedback')
    ->group(function () {
        Route::prefix('callback')
            ->group(function () {
                Route::patch('{pk}/set-status/{value}', SetValueAction::class)
                    ->whereIn('value', FeedbackStatusEnum::values())
                    ->setBindingFields([
                        'model' => fn ($pk) => Callback::query()->findOrFail($pk),
                        'field' => 'status',
                    ])
                    ->name('set-status');

                Route::apiResource('', CallbackController::class)->except(['create', 'update']);
            });
    });
