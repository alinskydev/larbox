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
        $this->app->singleton('settings', function ($app) {
            return new SettingsSingleton();
        });

        $this->app->singleton('language', function ($app) {
            return new LanguageSingleton();
        });

        try {
            app('language');
        } catch (\Throwable $e) {
        }
    }
}
