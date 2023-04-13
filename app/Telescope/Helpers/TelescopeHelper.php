<?php

namespace App\Telescope\Helpers;

class TelescopeHelper
{
    public static function extraData(): array
    {
        $startTime = defined('LARAVEL_START') ? LARAVEL_START : null;

        return [
            'duration' => $startTime ? floor((microtime(true) - $startTime) * 1000) : null,
            'memory' => round(memory_get_peak_usage(true) / 1024 / 1024, 1),
        ];
    }
}
