<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Mail;
use App\Services\LocalizationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(100);

        LocalizationService::getInstance()->setLocaleAndGetRouteParameter();

        ImageManagerStatic::configure(['driver' => 'imagick']);

        if (config('app.env') == 'local') {
            Mail::alwaysTo('admin@local.host');
        }

        $migrationsPath = glob(base_path('modules/*/Database/Migrations'));
        $this->loadMigrationsFrom($migrationsPath);
    }
}
