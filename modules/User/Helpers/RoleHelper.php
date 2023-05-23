<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RoleHelper
{
    private static array $excludedRoutes = [
        '_ignition.*',
        'telescope',
        'telescope.*',
        'sanctum.*',

        'admin.user.notification.index',
        'admin.user.notification.show',
        'admin.user.notification.seeAll',
        'admin.user.profile.*',

        'common.*',
        'website.*',
    ];

    public static function routesList(): array
    {
        $routes = Route::getRoutes()->getRoutes();

        $result = array_map(function ($route) {
            $routePrefix = str_replace('/', '.', $route->getPrefix());
            $routeName = $route->getName();
            $routeName = "$routePrefix.$routeName";
            $routeName = trim($routeName, '.');

            return $routeName;
        }, $routes);

        $result = array_filter($result, fn ($value) => !Str::is(self::$excludedRoutes, $value));
        $result = array_values($result);

        return $result;
    }

    public static function routesTree(): array
    {
        $result = self::routesList();
        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        return $result;
    }
}
