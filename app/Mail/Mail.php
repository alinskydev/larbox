<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;
    
    public function subject($subject)
    {
        return parent::subject(__("mail.$subject"));
    }

    public function view($view, array $data = [])
    {
        $view = "mail.$view." . app()->getLocale();
        return parent::view($view, $data);
    }
}
