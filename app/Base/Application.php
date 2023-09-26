<?php

namespace App\Base;

use Illuminate\Foundation\Application as LaravelApplication;
use App\Routing\Router;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistar;
use App\Routing\ResourceRegistrar;

class Application extends LaravelApplication
{
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);

        $this->bindRouter();
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
