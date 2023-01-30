<?php

namespace App\Base;

use Illuminate\Foundation\Application as LaravelApplication;
use App\Routing\Router;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistar;
use App\Routing\ResourceRegistrar;
use Illuminate\Support\Arr;

class Application extends LaravelApplication
{
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);

        // $this->loadEnv();
        $this->bindRouter();
    }

    private function loadEnv()
    {
        $headers = getallheaders();

        $envFile = match (Arr::get($headers, 'ENV')) {
            '<ENV_KEY>' => '.env.alt',
            default => '.env',
        };

        $this->loadEnvironmentFrom($envFile);
    }

    private function bindRouter()
    {
        $this->singleton('router', function ($app) {
            return new Router($app['events'], $app);
        });

        $this->bind(BaseResourceRegistar::class, function ($app) {
            return new ResourceRegistrar($app['router']);
        });
    }
}
