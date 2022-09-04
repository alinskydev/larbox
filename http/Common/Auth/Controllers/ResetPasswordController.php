<?php

namespace Http\Common\Auth\Controllers;

use App\Http\Controllers\Controller;
use Http\Common\Auth\Requests\ResetPassword\SendCodeRequest;
use Http\Common\Auth\Requests\ResetPassword\VerifyCodeRequest;
use Http\Common\Auth\Requests\ResetPassword\SetNewPasswordRequest;
use Http\Common\Auth\Services\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public function sendCode(SendCodeRequest $request)
    {
        $userService = new ResetPasswordService($request->user);
        $userService->sendCode();

        return $this->success();
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        return $this->success();
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $userService = new ResetPasswordService($request->user);
        $userService->setNewPassword($request->new_password);

        return $this->success();
    }
}
