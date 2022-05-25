<?php

namespace Http\Common\Auth\Services;

use App\Services\ModelService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Http\Common\Auth\Mail\ResetPasswordMail;

class ResetPasswordService extends ModelService
{
    public function sendCode()
    {
        $reset_password_code = Str::random(8);

        $this->model->reset_password_code = $reset_password_code;
        $this->model->saveQuietly();

        Mail::to([$this->model->email])->send(new ResetPasswordMail($reset_password_code));
    }

    public function setNewPassword(string $password)
    {
        $this->model->password = Hash::make($password);
        $this->model->reset_password_code = null;
        $this->model->saveQuietly();
    }
}
