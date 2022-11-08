<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\System\Singletons\SettingsSingleton;
use Modules\System\Singletons\LanguageSingleton;

class SingletonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('settings', fn ($app) => new SettingsSingleton());
        $this->app->singleton('language', fn ($app) => new LanguageSingleton());

        try {
            app('language');
        } catch (\Throwable $e) {
        }
    }
}
