<?php

namespace Modules\Auth\Mail;

use App\Base\Mail;

class CodeMail extends Mail
{
    public function __construct(
        public string $code,
    ) {
    }

    public function build(): self
    {
        return $this->subject(__('Код подтверждения'))->view('code');
    }
}
