<?php

namespace App\NestedSet;

class NestedSetHelper
{
    public static function appendFullFieldToTree(
        array &$items,
        string $field,
        string $separator,
        array $prefix = [],
    ): void {
        $fullField = "full_$field";

        foreach ($items as &$item) {
            $fieldValue = $item[$field];
            $item[$fullField] = implode($separator, array_merge($prefix, [$fieldValue]));

            if ($item['children']) {
                self::appendFullFieldToTree($item['children'], $field, $separator, array_merge($prefix, [$fieldValue]));
            }
        }
    }
}
