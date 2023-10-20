<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\User\Models\Role;

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

    public static function routesList(bool $isFilteredByUser, ?Role $role = null): array
    {
        $role ??= request()->user()->role ?? null;

        if ($isFilteredByUser && !$role) return [];

        $routes = Route::getRoutes()->getRoutes();

        $result = array_map(function ($route) {
            $routePrefix = str_replace('/', '.', $route->getPrefix());
            $routeName = $route->getName();
            $routeName = "$routePrefix.$routeName";
            $routeName = trim($routeName, '.');

            return $routeName;
        }, $routes);

        $result = array_filter($result, function ($value) use ($isFilteredByUser, $role) {
            if (Str::is(self::$excludedRoutes, $value)) return false;
            return !$isFilteredByUser || Str::is($role->routes, $value);
        });

        $result = array_values($result);

        return $result;
    }

    public static function routesTree(bool $isFilteredByUser): array
    {
        $result = self::routesList($isFilteredByUser);
        $result = array_combine($result, $result);
        $result = Arr::undot($result);

        return $result;
    }

    public static function groupRoutesByCount(array $routes): array
    {
        $result = [];

        foreach ($routes as $route) {
            $matches = explode('.', $route);

            $fullMatch = [];

            foreach ($matches as $match) {
                $fullMatch[] = $match;
                $key = implode('.', $fullMatch);

                $result[$key] ??= 0;
                $result[$key]++;
            }
        }

        $result = array_filter($result, fn ($value) => $value > 1);

        return $result;
    }
}
