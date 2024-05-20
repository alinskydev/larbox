<?php

namespace App\Helpers;

class ClassHelper
{
    public static function classByFile(string $file): string
    {
        $basePath = base_path();

        $file = str_replace($basePath, '', $file);
        $file = mb_substr($file, 1);
        $file = preg_replace("/\.php$/", '', $file);

        $file = str_replace('/', '\\', $file);
        $file = ucfirst($file);

        return $file;
    }
}
