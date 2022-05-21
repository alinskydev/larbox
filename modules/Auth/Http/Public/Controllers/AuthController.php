<?php

namespace Modules\Auth\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Modules\Auth\Http\Public\Requests\Auth\LoginRequest;
use Modules\Auth\Http\Public\Requests\Auth\RegisterRequest;

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
