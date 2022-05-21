<?php

namespace Modules\Auth\Mail;

use App\Mail\Mail;

class ResetPasswordMail extends Mail
{
    public function __construct(
        public string $code
    ) {
    }

    public function build()
    {
        return $this->subject('auth_reset_password')->view('auth_reset_password');
    }
}
