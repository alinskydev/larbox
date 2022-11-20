<?php

use Illuminate\Support\Facades\Route;

use Http\Admin\System\Controllers\LanguageController;
use Http\Admin\System\Controllers\SettingsController;
use Http\Admin\System\Controllers\SystemController;
use App\Http\Controllers\Actions\SetValueAction;

use Modules\System\Models\Language;

Route::prefix('system')
    ->group(function () {
        Route::prefix('language')
            ->group(function () {
                Route::model('language', Language::class);

                Route::apiResource('', LanguageController::class)->only(['index', 'show', 'update']);

                Route::patch('{language}/set-active/{value}', SetValueAction::class)
                    ->whereIn('value', [0, 1])
                    ->setBindingFields(['field' => 'is_active'])
                    ->name('setActive');

                Route::patch('{language}/set-main/{value}', SetValueAction::class)
                    ->whereIn('value', [1])
                    ->setBindingFields(['field' => 'is_main'])
                    ->name('setMain');
            });

        Route::prefix('settings')
            ->group(function () {
                Route::get('', [SettingsController::class, 'index'])->name('index');
                Route::put('', [SettingsController::class, 'update'])->name('update');
            });
    });
