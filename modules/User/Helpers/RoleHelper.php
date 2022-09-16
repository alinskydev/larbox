<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class RoleHelper
{
    private static array $localizations = [
        'index' => 'Список',
        'show' => 'Просмотр',
        'store' => 'Создание',
        'index' => 'Список',
        'index' => 'Список',
    ];

    public static function list(string $prefix = ''): array
    {
        $result = [];

        $routeCollection = Route::getRoutes()->getRoutes();

        foreach ($routeCollection as $route) {
            $routePrefix = $route->getPrefix();
            $routePrefix = str_replace('/', '.', $route->getPrefix());
            $routeName = $route->getName();
            $routeName = "$routePrefix.$routeName";

            $result[] = $routeName;
        }

        $result = array_filter($result, fn ($value) => str_starts_with($value, $prefix));
        $result = array_combine($result, $result);

        $result = Arr::undot($result);

        array_walk_recursive($result, function (&$value, $key) {
            $value = self::$localizations[$key] ?? $value;
        });

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die;

        return $result;
    }
}
