<?php

namespace App\Mail;

use Illuminate\Support\Facades\View;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    public function view($view, array $data = [])
    {
        $calledClass = get_called_class();
        $calledClassReflection = new \ReflectionClass($calledClass);
        $calledClassFile = $calledClassReflection->getFileName();
        $calledClassDir = dirname($calledClassFile);

        View::addNamespace('Mail', $calledClassDir . '/views');

        $view = "Mail::$view." . app()->getLocale();
        return parent::view($view, $data);
    }
}
