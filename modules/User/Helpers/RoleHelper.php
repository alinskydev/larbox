<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class RoleHelper
{
    protected string $routesPrefix;
    protected array $excludedRoutes = [];

    public function __construct(
        protected bool $routesWithAsterisk,
    ) {
    }

    public function routes(): array
    {
        $result = [];

        $routeCollection = Route::getRoutes()->getRoutes();

        foreach ($routeCollection as $route) {
            $routePrefix = $route->getPrefix();
            $routePrefix = str_replace('/', '.', $route->getPrefix());
            $routeName = $route->getName();
            $routeName = "$routePrefix.$routeName";

            if (str_starts_with($routeName, $this->routesPrefix)) {
                if ($this->routesWithAsterisk) {
                    $routeNameArr = explode('.', $routeName);
                    array_pop($routeNameArr);

                    $prevPrefix = '';

                    foreach ($routeNameArr as $prefix) {
                        $prevPrefix .= "$prefix.";
                        $result[] = "$prevPrefix*";
                    }
                }

                $result[] = $routeName;
            }
        }

        $result = array_unique($result);

        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        foreach ($this->excludedRoutes as $route) {
            Arr::forget($result, "$this->routesPrefix.$route");
        }

        $result = Arr::dot($result);
        $result = array_values($result);

        return $result;
    }

    public function routesTree(): array
    {
        $result = $this->routes($this->routesPrefix);
        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        return $result;
    }
}
