<?php

namespace App\Helpers;

use Mews\Purifier\Facades\Purifier;

class HtmlPurifierHelper
{
    public static function process(array $data): array
    {
        array_walk_recursive($data, function (&$value, $key) {
            $value = is_string($value) ? Purifier::clean($value) : $value;
        });

        return $data;
    }
}
