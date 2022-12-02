<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\System\Singletons\SettingsSingleton;
use Modules\System\Singletons\LanguageSingleton;

class SingletonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton('settings', fn ($app) => new SettingsSingleton());
        $this->app->singleton('language', fn ($app) => new LanguageSingleton());

        try {
            app('language');
        } catch (\Throwable $e) {
        }
    }
}
