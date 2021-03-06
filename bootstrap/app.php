<?php

use App\Routing\Router;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistar;
use App\Routing\ResourceRegistrar;

use Illuminate\Support\Arr;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Checking API type and setting database name

$headers = getallheaders();

$envFile = match (Arr::get($headers, 'ENV')) {
        // 'NIMyG6tVOpAir7VioWGLZLWJwnJ67CCp' => '.env.debug',
    default => '.env',
};

// if (Arr::get($headers, 'Debug-Key') == 'vu8eaajiaw') {
//     $envFile = '.env.debug';
// }

$app->loadEnvironmentFrom($envFile);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

//  Binding router

$app->singleton('router', function ($app) {
    return new Router($app['events'], $app);
});

$app->bind(BaseResourceRegistar::class, function ($app) {
    return new ResourceRegistrar($app['router']);
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
