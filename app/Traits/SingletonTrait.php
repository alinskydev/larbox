<?php

namespace App\Traits;

trait SingletonTrait
{
    private static ?self $instance = null;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
