<?php

namespace Modules\User\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Modules\User\Helpers\RoleHelper;
use Illuminate\Support\Str;

class RoleMiddleware
{
    public function handle(Request $request, \Closure $next): Response
    {
        $role = request()->user()->role;

        if (!$role) abort(401);

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
