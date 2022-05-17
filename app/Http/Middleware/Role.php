<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, \Closure $next, mixed ...$roles)
    {
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        } else {
            abort(401, 'Invalid credentials');
        }
    }
}
