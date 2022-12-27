<?php

namespace Http\Common\Auth\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Http\Common\Auth\Requests\Auth\LoginRequest;
use Http\Common\Auth\Requests\Auth\RegisterRequest;
use Modules\User\Services\UserService;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $userService = new UserService(request()->user());
        $userService->assignNewAccessToken();

        return response()->json(['token' => request()->user()->newAccessToken], 200);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $request->model->safelySave($request->validatedData);
        return response()->json(['token' => $request->model->newAccessToken], 200);
    }
}
