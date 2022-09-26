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
        Schema::defaultStringLength(255);

        ImageManagerStatic::configure(['driver' => 'gd']);

        $migrationsPath = glob(base_path('modules/*/Database/Migrations/*.php'));
        $this->loadMigrationsFrom($migrationsPath);
    }
}
