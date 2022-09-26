<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Modules\User\Helpers\RoleHelper;

class Role
{
    public function handle(Request $request, \Closure $next)
    {
        // Cheking role existance

        $role = auth()->user()->role;

        if (!$role) abort(403);

        // Checking route availability

        $routePrefix = str_replace('/', '.', request()->route()->getPrefix());
        $routeName = request()->route()->getName();
        $routeName = "$routePrefix.$routeName";
        $routeName = trim($routeName, '.');

        $routes = RoleHelper::routesList(false);

        if (!in_array($routeName, $routes) || in_array($routeName, $role->routes)) return $next($request);

        // Checking route availability by asterisks

        $routeNameArr = explode('.', $routeName);

        for ($i = 0; $i < count($routeNameArr); $i++) {
            $routeName = array_slice($routeNameArr, 0, $i);
            $routeName = $routeName ? implode('.', $routeName) . '.*' : '*';

            if (in_array($routeName, $role->routes)) return $next($request);
        }

        return abort(403, __('У вас нет доступа для совершения данного действия'));
    }
}
