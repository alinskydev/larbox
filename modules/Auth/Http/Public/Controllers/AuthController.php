<?php

namespace Modules\Auth\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Modules\Auth\Http\Public\Requests\AuthLoginRequest;
use Modules\Auth\Http\Public\Requests\AuthRegisterRequest;
use Modules\Auth\Http\Public\Requests\AuthResetPasswordSendEmailRequest;
use Modules\Auth\Http\Public\Requests\AuthResetPasswordRequest;
use Modules\User\Services\UserService;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $response = [
            'token' => 'Basic ' . base64_encode("$request->username:$request->password"),
            'data' => JsonResource::make($request->user),
        ];

        return response()->json($response, 200);
    }

    public function register(AuthRegisterRequest $request)
    {
        $request->model->fill($request->validated())->save();

        $response = [
            'token' => 'Basic ' . base64_encode("$request->username:$request->new_password"),
            'data' => JsonResource::make($request->model),
        ];

        return response()->json($response, 200);
    }

    public function resetPasswordSendEmail(AuthResetPasswordSendEmailRequest $request)
    {
        $userService = new UserService($request->user);
        $userService->sendResetPasswordCode();

        return response()->json('', 204);
    }

    public function resetPassword(AuthResetPasswordRequest $request)
    {
        $userService = new UserService($request->user);
        $userService->resetPassword($request->new_password);

        $response = [
            'token' => 'Basic ' . base64_encode("{$request->user->username}:$request->new_password"),
            'data' => JsonResource::make($request->user),
        ];

        return response()->json($response, 200);
    }
}
