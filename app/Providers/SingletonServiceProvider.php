<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\System\Services\SettingsService;
use Modules\System\Services\LanguageService;

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
            return new SettingsService();
        });

        $this->app->singleton('language', function ($app) {
            return new LanguageService();
        });

        app('language');
    }
}
