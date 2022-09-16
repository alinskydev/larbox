<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Modules\User\Helpers\RoleHelper;

class Role
{
    public function handle(Request $request, \Closure $next)
    {
        $role = auth()->user()->role;

        if (!$role) abort(403);

        echo '<pre>';
        print_r(RoleHelper::list('admin'));
        echo '</pre>';
        die;

        // $action = request()->route()->uri() . '/' . request()->route()->getActionMethod();

        // echo '<pre>';
        // print_r($action);
        // echo '</pre>';
        // die;

        // echo '<pre>';
        // print_r(request()->route()->uri());
        // echo '</pre>';
        // die;

        $routePrefix = request()->route()->getPrefix();
        $routePrefix = str_replace('/', '.', request()->route()->getPrefix());
        $routeName = request()->route()->getName();
        $routeName = "$routePrefix.$routeName";

        echo '<pre>';
        print_r($routeName);
        echo '</pre>';
        die;

        return $next($request);
    }
}
