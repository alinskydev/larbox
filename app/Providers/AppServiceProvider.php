<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\Sanctum;
use Barryvdh\Debugbar\Facades\Debugbar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    public function boot(): void
    {
        Schema::defaultStringLength(255);
        ImageManagerStatic::configure(['driver' => 'gd']);

        if (request()->ip() != env('DEBUGBAR_ALLOWED_IP')) {
            Debugbar::disable();
        }
    }
}
