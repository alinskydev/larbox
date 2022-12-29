<?php

namespace App\Helpers;

use Mews\Purifier\Facades\Purifier;

class HtmlPurifierHelper
{
    public static function process(array $data): array
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$v, $k) {
                    if (is_string($v)) {
                        $v = Purifier::clean($v);
                    }
                });
            } else {
                if (is_string($value)) {
                    $value = Purifier::clean($value);
                }
            }
        }

        return $data;
    }
}
