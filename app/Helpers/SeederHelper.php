<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SeederHelper
{
    public static function localized(string $string, bool $hasLanguageSuffix = true): string
    {
        $class = require(base_path('modules/System/Database/Seeders/system_language.php'));
        $languages = Arr::keyBy($class->data, 'code');

        $result = array_map(fn ($value) => $hasLanguageSuffix ?  "$string " . $value['code'] : $string, $languages);
        return json_encode($result);
    }

    public static function slug(string $string, bool $hasLanguageSuffix = true): string
    {
        $slug = Str::slug($string);
        return $hasLanguageSuffix ? "$slug-" . app()->getLocale() : $slug;
    }

    public static function multiply(array $indexes, callable $callback): array
    {
        return array_map($callback, $indexes);
    }
}
