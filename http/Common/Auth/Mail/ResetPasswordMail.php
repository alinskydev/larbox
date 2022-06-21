<?php

namespace Http\Common\Auth\Mail;

use App\Mail\Mail;

class ResetPasswordMail extends Mail
{
    public function __construct(
        public string $code
    ) {
    }

    public function build()
    {
        return $this->subject(__('Восстановление пароля'))
            ->view('auth_reset_password');
    }
}
