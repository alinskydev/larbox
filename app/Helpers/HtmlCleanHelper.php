<?php

namespace App\Helpers;

use Mews\Purifier\Facades\Purifier;

class HtmlCleanHelper
{
    public const TYPE_NONE = 'none';
    public const TYPE_PURIFY = 'purify';
    public const TYPE_STRIP_TAGS = 'stripTags';

    /**
     * @param array $data
     * @param string $type
     * @return array
     */
    public static function process($data, $type)
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$v, $k) use ($type) {
                    if (is_string($v)) {
                        $v = self::processValue($v, $type);
                    }
                });
            } else {
                if (is_string($value)) {
                    $value = self::processValue($value, $type);
                }
            }
        }

        return $data;
    }

    /**
     * @param ?string $value
     * @param string $type
     * @return string
     */
    private static function processValue($value, $type)
    {
        return match ($type) {
            self::TYPE_PURIFY => Purifier::clean($value),
            self::TYPE_STRIP_TAGS => strip_tags($value),
            default => $value,
        };
    }
}
