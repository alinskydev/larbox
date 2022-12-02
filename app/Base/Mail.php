<?php

namespace App\Base;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    public function view($view, array $data = []): static
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
