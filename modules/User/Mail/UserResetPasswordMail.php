<?php

namespace Modules\User\Mail;

use App\Mail\Mail;

class UserResetPasswordMail extends Mail
{
    public function __construct(
        public string $code
    ) {
    }

    public function build()
    {
        return $this->subject('user_reset_password')->view('user_reset_password');
    }
}
