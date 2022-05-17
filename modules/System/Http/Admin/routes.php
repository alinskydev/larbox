<?php

use Illuminate\Support\Facades\Route;

use Modules\System\Http\Admin\Controllers\SystemLanguageController;
use Modules\System\Http\Admin\Controllers\SystemSettingsController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\System\Models\SystemLanguage;

Route::prefix('system')
    ->where([
        'language' => '[0-9]+',
    ])
    ->group(function () {
        Route::model('language', SystemLanguage::class);

        Route::apiResource('language', SystemLanguageController::class)->only(['index', 'show', 'update']);

        Route::get('settings', [SystemSettingsController::class, 'index']);
        Route::post('settings', [SystemSettingsController::class, 'update']);

        Route::post('language/{language}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);

        Route::post('language/{language}/set-main/{value}', SetValueAction::class)
            ->whereIn('value', [1])
            ->setBindingFields(['field' => 'is_main']);
    });
