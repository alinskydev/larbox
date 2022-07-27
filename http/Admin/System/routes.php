<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\System\Controllers\LanguageController;
use Http\Admin\System\Controllers\SettingsController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\System\Models\Language;

Route::prefix('system')
    ->where([
        'language' => '[0-9]+',
    ])
    ->group(function () {
        Route::apiResource('language', LanguageController::class)->only(['index', 'show', 'update']);

        Route::model('language', Language::class);

        Route::patch('language/{language}/set-active/{value}', SetValueAction::class)
            ->whereIn('value', [0, 1])
            ->setBindingFields(['field' => 'is_active']);

        Route::patch('language/{language}/set-main/{value}', SetValueAction::class)
            ->whereIn('value', [1])
            ->setBindingFields(['field' => 'is_main']);

        Route::prefix('settings')
            ->group(function () {
                Route::get('', [SettingsController::class, 'index']);
                Route::put('', [SettingsController::class, 'update']);
            });
    });
