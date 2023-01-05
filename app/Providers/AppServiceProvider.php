<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Laravel\Sanctum\Sanctum;
use Modules\User\Models\AccessToken;
use Illuminate\Validation\Rules\Password;
use Barryvdh\Debugbar\Facades\Debugbar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    public function boot(): void
    {
        $this->bootCommon();
        $this->bootDev();
    }

    private function bootCommon()
    {
        Schema::defaultStringLength(255);
        ImageManagerStatic::configure(['driver' => 'gd']);
        Password::defaults(fn () => Password::min(8));
        Sanctum::usePersonalAccessTokenModel(AccessToken::class);
    }

    private function bootDev()
    {
        if (request()->ip() != env('DEBUGBAR_ALLOWED_IP')) {
            Debugbar::disable();
        }
    }
}
