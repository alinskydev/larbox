<?php

namespace Modules\Auth\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Modules\Auth\Http\Public\Requests\ResetPassword\SendEmailRequest;
use Modules\Auth\Http\Public\Requests\ResetPassword\VerifyCodeRequest;
use Modules\Auth\Http\Public\Requests\ResetPassword\SetNewPasswordRequest;
use Modules\User\Services\UserService;

class ResetPasswordController extends Controller
{
    public function sendEmail(SendEmailRequest $request)
    {
        $userService = new UserService($request->user);
        $userService->sendResetPasswordCode();

        return response()->json('', 204);
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        return response()->json('', 204);
    }

    public function setNewPassword(SetNewPasswordRequest $request)
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
