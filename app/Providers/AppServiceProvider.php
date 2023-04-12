<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\Sanctum;
use Modules\User\Models\AccessToken;
use Illuminate\Validation\Rules\Password;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Sanctum::ignoreMigrations();
        Telescope::ignoreMigrations();
    }

    public function boot(): void
    {
        $this->bootCommon();
        // $this->bootLocal();
    }

    private function bootCommon()
    {
        Schema::defaultStringLength(255);
        ImageManagerStatic::configure(['driver' => 'gd']);
        Password::defaults(fn () => Password::min(8));
        Sanctum::usePersonalAccessTokenModel(AccessToken::class);
    }

    private function bootLocal()
    {
    }
}
