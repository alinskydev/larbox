<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\System\Controllers\LanguageController;
use Http\Admin\System\Controllers\SettingsController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\System\Models\Language;

Route::prefix('system')
    ->group(function () {
        Route::prefix('language')
            ->group(function () {
                Route::patch('{pk}/set-active/{value}', SetValueAction::class)
                    ->whereIn('value', [0, 1])
                    ->setBindingFields([
                        'model' => fn ($pk) => Language::query()->findOrFail($pk),
                        'field' => 'is_active',
                    ])
                    ->name('set-active');

                Route::patch('{pk}/set-main/{value}', SetValueAction::class)
                    ->whereIn('value', [1])
                    ->setBindingFields([
                        'model' => fn ($pk) => Language::query()->findOrFail($pk),
                        'field' => 'is_main',
                    ])
                    ->name('set-main');

                Route::apiResource('', LanguageController::class)->only(['index', 'show', 'update']);
            });

        Route::prefix('settings')
            ->group(function () {
                Route::get('', [SettingsController::class, 'index'])->name('index');
                Route::put('', [SettingsController::class, 'update'])->name('update');
            });
    });
