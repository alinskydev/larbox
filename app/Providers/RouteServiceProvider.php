<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

use App\Services\LocalizationService;

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
            if (!app()->runningInConsole()) {
                $localization = LocalizationService::getInstance();
                $locale = $localization->setLocaleAndGetRouteParameter();
            } else {
                $locale = config('app.locale');
            }

            Route::group(['prefix' => "api/$locale"], function () {
                $base_path = base_path();

                Route::middleware('auth.basic.once', 'role:admin', 'api')
                    ->prefix('admin')
                    ->group(glob("$base_path/Modules/*/Http/Admin/routes.php"));

                Route::withoutMiddleware()
                    ->group(glob("$base_path/Modules/*/Http/Public/routes.php"));
            });
        });

        Route::pattern('id', '[0-9]+');
        Route::pattern('index', '[0-9]+');

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
