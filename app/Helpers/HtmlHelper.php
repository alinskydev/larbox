<?php

namespace App\Helpers;

use Mews\Purifier\Facades\Purifier;

class HtmlHelper
{
    const CLEAN_TYPE_STRIP_TAGS = 'stripTags';
    const CLEAN_TYPE_PURIFY = 'purify';
    const CLEAN_TYPE_NONE = 'none';

    public static function clean(array $data, array $ignoredFields = [], string $type)
    {
        if ($type == self::CLEAN_TYPE_NONE) {
            return $data;
        }

        $fields = array_filter(
            $data,
            fn ($key) => !in_array($key, $ignoredFields),
            ARRAY_FILTER_USE_KEY
        );

        foreach ($fields as &$value) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$v, $k) use ($type) {
                    $v = self::cleanValue($v, $type);
                });
            } else {
                $value = self::cleanValue($value, $type);
            }
        }

        return array_merge($data, $fields);
    }

    private static function cleanValue(string $value, string $type)
    {
        // switch ($type) {
        //     case self::CLEAN_TYPE_STRIP_TAGS:
        //         return strip_tags($value);
        //     case self::CLEAN_TYPE_PURIFY:
        //         return Purifier::clean($value);
        //     default:
        //         return '';
        // }

        return match($type) {
            self::CLEAN_TYPE_STRIP_TAGS => strip_tags($value),
            self::CLEAN_TYPE_PURIFY => Purifier::clean($value),
            default => '',
        };
    }
}
