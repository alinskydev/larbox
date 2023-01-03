<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SeederHelper
{
    public static function localized(?string $string, bool $hasLanguageSuffix = true): string
    {
        $languages = config('larbox.languages');

        $locales = array_keys($languages);
        $locales = array_combine($locales, $locales);

        $result = array_map(fn ($locale) => $hasLanguageSuffix ? "$string $locale" : $string, $locales);
        return json_encode($result);
    }

    public static function slug(string $string, bool $hasLanguageSuffix = true): string
    {
        $string = $hasLanguageSuffix ? "$string " . app()->getLocale() : $string;
        return Str::slug($string);
    }

    public static function multiply(array $indexes, callable $callback): array
    {
        return array_map($callback, $indexes);
    }
}
