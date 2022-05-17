<?php

use Illuminate\Support\Facades\Route;

use Modules\Task\Http\Public\Controllers\TaskController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\Task\Models\Task;
use Modules\Task\Enums\TaskEnums;

use Illuminate\Support\Arr;

Route::prefix('task')
    ->middleware('auth.basic.once', 'role:agent', 'api')
    ->group(function () {
        Route::model('task', Task::class);

        Route::apiResource('task', TaskController::class)->only(['index', 'show']);

        Route::post('task/{task}/set-agent_status/{value}', SetValueAction::class)
            ->whereIn('value', array_keys(Arr::except(TaskEnums::agentStatuses(), ['opened', 'overdue'])))
            ->setBindingFields(['field' => 'agent_status']);
    });
