<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticateOnceWithBasicAuth
{
    public function handle(Request $request, \Closure $next)
    {
        return Auth::onceBasic('username') ?: $next($request);
    }
}
