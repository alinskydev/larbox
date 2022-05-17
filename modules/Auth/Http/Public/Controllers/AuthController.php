<?php

namespace Modules\Auth\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Resources\UserResource;
use Modules\Auth\Http\Public\Requests\AuthLoginRequest;
use Modules\Auth\Http\Public\Requests\ResetPasswordSendEmailRequest;
use Modules\Auth\Http\Public\Requests\ResetPasswordRequest;
use Modules\User\Services\UserService;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $responce = [
            'token' => 'Basic ' . base64_encode("$request->username:$request->password"),
            'data' => UserResource::make($request->user),
        ];

        return response()->json($responce, 200);
    }

    public function resetPasswordSendEmail(ResetPasswordSendEmailRequest $request)
    {
        $userService = new UserService($request->user);
        $userService->sendResetPasswordCode();

        return response()->json('', 204);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $userService = new UserService($request->user);
        $userService->resetPassword($request->new_password);

        $responce = [
            'token' => 'Basic ' . base64_encode("{$request->user->username}:$request->new_password"),
            'data' => UserResource::make($request->user),
        ];

        return response()->json($responce, 200);
    }
}
