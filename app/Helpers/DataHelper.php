<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class DataHelper
{
    public static function localized(string $string, bool $hasLanguageSuffix = true)
    {
        $class = require(base_path('modules/System/Database/Seeders/system_language-create.php'));
        $languages = Arr::keyBy($class->data, 'code');

        $result = array_map(fn ($value) => $hasLanguageSuffix ?  "$string " . $value['code'] : $string, $languages);
        return json_encode($result);
    }

    public static function multiply(array $indexes, callable $callback)
    {
        return array_map($callback, $indexes);
    }
}
