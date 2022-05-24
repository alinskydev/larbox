<?php

namespace Http\Common\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Http\Common\Auth\Requests\Auth\LoginRequest;
use Http\Common\Auth\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $response = [
            'token' => 'Basic ' . base64_encode("$request->username:$request->password"),
            'data' => JsonResource::make($request->user),
        ];

        return response()->json($response, 200);
    }

    public function register(RegisterRequest $request)
    {
        $response = [
            'token' => 'Basic ' . base64_encode("$request->username:$request->new_password"),
            'data' => JsonResource::make($request->model),
        ];

        return response()->json($response, 200);
    }
}
