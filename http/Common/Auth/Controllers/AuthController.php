<?php

namespace Http\Common\Auth\Controllers;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

use Http\Common\Auth\Requests\Auth\LoginRequest;
use Http\Common\Auth\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        request()->user()->getService()->createNewAccessToken();
        return $this->successResponseWithAccessToken(request()->user());
    }

    public function register(RegisterRequest $request): Response
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponseWithAccessToken($request->model);
    }
}
