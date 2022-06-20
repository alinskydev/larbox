<?php

namespace Http\Common\Auth\Controllers;

use App\Http\Controllers\Controller;
use Http\Common\Auth\Requests\Auth\LoginRequest;
use Http\Common\Auth\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $response = [
            'message' => 'Successfully logined',
        ];

        return response()->json($response, 200);
    }

    public function register(RegisterRequest $request)
    {
        $response = [
            'message' => 'Successfully registered',
        ];

        return response()->json($response, 200);
    }
}
