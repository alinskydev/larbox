<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->group(function () {
                    Route::prefix('admin')
                        ->middleware(['auth.basic.once', 'role'])
                        ->group(glob(base_path('http/Admin/*/routes.php')));

                    Route::prefix('common')
                        ->group(glob(base_path('http/Common/*/routes.php')));

                    Route::prefix('website')
                        ->group(glob(base_path('http/Website/*/routes.php')));
                });
        });

        Route::pattern('id', '[0-9]+');
        Route::pattern('index', '[0-9]+');

        parent::boot();
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            $limit = config('app.env') == 'production' ? 300 : 1000;
            return Limit::perMinute($limit)->by($request->user()?->id ?: $request->ip());
        });
    }
}
