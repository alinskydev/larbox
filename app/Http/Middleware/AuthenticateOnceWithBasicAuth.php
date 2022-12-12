<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
{
    public function handle(Request $request, \Closure $next, string $field = 'username'): Response
    {
        return Auth::onceBasic($field) ?: $next($request);
    }
}
