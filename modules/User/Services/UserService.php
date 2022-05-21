<?php

namespace Modules\User\Services;

use App\Services\ActiveService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Mail\AuthResetPasswordMail;

class UserService extends ActiveService
{
    public function sendResetPasswordCode()
    {
        $reset_password_code = Str::random(8);

        $this->model->reset_password_code = $reset_password_code;
        $this->model->saveQuietly();

        Mail::to([$this->model->email])->send(new AuthResetPasswordMail($reset_password_code));
    }

    public function resetPassword(string $password)
    {
        $this->model->password = Hash::make($password);
        $this->model->reset_password_code = null;
        $this->model->saveQuietly();
    }
}
