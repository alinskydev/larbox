<?php

namespace Modules\Auth\Mail;

use App\Mail\Mail;

class CodeMail extends Mail
{
    public function __construct(
        public string $code,
    ) {
    }

    public function build()
    {
        return $this->subject(__('Код подтверждения'))->view('code');
    }
}
