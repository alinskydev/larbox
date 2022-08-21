<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->group(function () {
                    Route::prefix('admin')
                        ->middleware(['auth.basic.once', 'role:admin'])
                        ->group(glob(base_path('http/Admin/*/routes.php')));

                    Route::group([], glob(base_path('http/Common/*/routes.php')));
                    Route::group([], glob(base_path('http/Public/*/routes.php')));
                });
        });

        Route::pattern('id', '[0-9]+');
        Route::pattern('index', '[0-9]+');
        Route::pattern('model', '[0-9]+');

        parent::boot();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
