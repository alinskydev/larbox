<?php

namespace Http\Common\Auth\Controllers;

use App\Base\Controller;
use Http\Common\Auth\Requests\Auth\LoginRequest;
use Http\Common\Auth\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $this->successResponse();
    }

    public function register(RegisterRequest $request)
    {
        return $this->successResponse();
    }
}
