<?php

namespace Http\Common\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Http\Common\Auth\Requests\ResetPassword\SendEmailRequest;
use Http\Common\Auth\Requests\ResetPassword\VerifyCodeRequest;
use Http\Common\Auth\Requests\ResetPassword\SetNewPasswordRequest;
use Http\Common\Auth\Services\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public function sendEmail(SendEmailRequest $request)
    {
        $userService = new ResetPasswordService($request->user);
        $userService->sendCode();

        return response()->json('', 204);
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        return response()->json('', 204);
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $userService = new ResetPasswordService($request->user);
        $userService->setNewPassword($request->new_password);

        $response = [
            'token' => 'Basic ' . base64_encode("{$request->user->username}:$request->new_password"),
            'data' => JsonResource::make($request->user),
        ];

        return response()->json($response, 200);
    }
}
