<?php

namespace Http\Common\Auth\Services;

use App\Services\ActiveService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Http\Common\Auth\Mail\ResetPasswordMail;

class ResetPasswordService extends ActiveService
{
    public function sendCode()
    {
        $resetPasswordCode = Str::random(8);

        $this->model->reset_password_code = $resetPasswordCode;
        $this->model->saveQuietly();

        Mail::to([$this->model->email])->send(new ResetPasswordMail($resetPasswordCode));
    }

    public function setNewPassword(string $password)
    {
        $this->model->password = Hash::make($password);
        $this->model->reset_password_code = null;
        $this->model->saveQuietly();
    }
}
