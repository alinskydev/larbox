<?php

namespace App\Base;

use Illuminate\Support\Facades\View;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param string  $view
     * @param array  $data
     * @return $this
     */
    public function view($view, $data = [])
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
