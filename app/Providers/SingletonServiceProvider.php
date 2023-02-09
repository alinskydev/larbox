<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\System\Singletons\SettingsSingleton;
use Modules\System\Singletons\LanguageSingleton;

class SingletonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton('language', LanguageSingleton::class);
        $this->app->singleton('settings', SettingsSingleton::class);

        try {
            app('language');
            app('settings');
        } catch (\Throwable $e) {
        }
    }
}
