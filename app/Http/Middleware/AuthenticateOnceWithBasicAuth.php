<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
{
    public function handle(Request $request, \Closure $next, string $field = 'username'): JsonResponse
    {
        return Auth::onceBasic($field) ?: $next($request);
    }
}
