<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class RoleHelper
{
    private static array $excludedRoutes = [
        'admin.system.information',
        'admin.user.notification.index',
        'admin.user.notification.show',
        'admin.user.notification.seeAll',
        'admin.user.profile',
    ];

    public static function routesList(bool $routesWithAsterisk): array
    {
        $result = [];

        $routeCollection = Route::getRoutes()->getRoutes();

        foreach ($routeCollection as $route) {
            $routePrefix = str_replace('/', '.', $route->getPrefix());
            $routeName = $route->getName();
            $routeName = "$routePrefix.$routeName";
            $routeName = trim($routeName, '.');

            if ($routesWithAsterisk) {
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

        $result = array_unique($result);

        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        foreach (self::$excludedRoutes as $route) {
            Arr::forget($result, $route);
        }

        $result = Arr::dot($result);
        $result = array_values($result);

        return $result;
    }

    public static function routesTree(bool $routesWithAsterisk): array
    {
        $result = self::routesList($routesWithAsterisk);
        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        return $result;
    }
}
