<?php

use Illuminate\Support\Facades\Route;

use Modules\Task\Http\Admin\Controllers\TaskController;
use App\Http\Controllers\Actions\RestoreAction;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Task\Models\Task;
use Modules\Task\Enums\TaskEnums;

Route::prefix('task')
    ->where([
        'task' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('task', Task::class);

        Route::apiResource('task', TaskController::class);

        Route::delete('task/{id}/restore', RestoreAction::class)->setBindingFields(['modelClass' => Task::class]);

        Route::post('task/{task}/set-admin_status/{value}', SetValueAction::class)
            ->whereIn('value', array_keys(TaskEnums::adminStatuses()))
            ->setBindingFields(['field' => 'admin_status']);
    });
