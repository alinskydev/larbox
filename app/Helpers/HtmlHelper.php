<?php

namespace App\Helpers;

class HtmlHelper
{
    public static function removeTags(array $data, array $ignoredFields = [])
    {
        $fields = array_filter(
            $data,
            fn ($key) => !in_array($key, $ignoredFields),
            ARRAY_FILTER_USE_KEY
        );

        foreach ($fields as &$value) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$v, $k) {
                    $v = strip_tags($v);
                });
            } else {
                $value = strip_tags($value);
            }
        }

        return array_merge($data, $fields);
    }
}
