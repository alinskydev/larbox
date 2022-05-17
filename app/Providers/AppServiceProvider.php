<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Mail;

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
        ImageManagerStatic::configure(['driver' => 'imagick']);
        
        if (config('app.env') == 'local') {
            Mail::alwaysTo('alinsky.dmitry@gmail.com');
        }

        $basePath = base_path();
        $migrationsPath = glob("$basePath/modules/*/Database/Migrations");

        $this->loadMigrationsFrom($migrationsPath);
    }
}
