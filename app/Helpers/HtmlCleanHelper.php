<?php

namespace App\Helpers;

use Mews\Purifier\Facades\Purifier;

class HtmlCleanHelper
{
    const TYPE_NONE = 'none';
    const TYPE_PURIFY = 'purify';
    const TYPE_STRIP_TAGS = 'stripTags';

    public static function process(array $data, string $type)
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$v, $k) use ($type) {
                    $v = self::processValue($v, $type);
                });
            } else {
                $value = self::processValue($value, $type);
            }
        }

        return $data;
    }

    private static function processValue(?string $value, string $type)
    {
        return match($type) {
            self::TYPE_PURIFY => Purifier::clean($value),
            self::TYPE_STRIP_TAGS => strip_tags($value),
            default => '',
        };
    }
}
