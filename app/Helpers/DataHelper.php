<?php

namespace App\Helpers;

class DataHelper
{
    public static function localized(string $string, bool $hasLanguageSuffix = true)
    {
        $languages = ['ru', 'uz', 'en'];
        $languages = array_combine($languages, $languages);

        $result = array_map(fn ($value) => $hasLanguageSuffix ? "$string $value" : $string, $languages);

        return json_encode($result);
    }

    public static function multiply(array $indexes, callable $callback)
    {
        return array_map($callback, $indexes);
    }
}
