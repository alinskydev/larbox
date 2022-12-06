<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\User\Helpers\RoleHelper;
use Illuminate\Support\Str;

class Role
{
    public function handle(Request $request, \Closure $next): JsonResponse
    {
        if (!($role = auth()->user()->role)) {
            abort(403, __('У вас нет доступа для совершения данного действия'));
        }

        $routePrefix = str_replace('/', '.', request()->route()->getPrefix());
        $routeName = request()->route()->getName();
        $routeName = "$routePrefix.$routeName";
        $routeName = trim($routeName, '.');

        $routes = RoleHelper::routesList();

        if (in_array($routeName, $routes) && !Str::is($role->routes, $routeName)) {
            abort(403, __('У вас нет доступа для совершения данного действия'));
        }

        return $next($request);
    }
}
