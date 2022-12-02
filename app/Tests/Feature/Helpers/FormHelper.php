<?php

namespace App\Tests\Feature\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Testing\File;

class FormHelper
{
    public static function localized(string $string): array
    {
        return array_map(fn ($value) => "$string " . $value['code'], app('language')->all);
    }

    public static function file(
        string $name = 'image.jpg',
        int $size = 100,
        string $mime = 'image/jpeg',
    ): File {
        return UploadedFile::fake()->create($name, $size, $mime);
    }

    public static function localizedFile(
        string $name = 'image.jpg',
        int $size = 100,
        string $mime = 'image/jpeg',
    ): array {
        return array_map(fn ($value) => UploadedFile::fake()->create($name, $size, $mime), app('language')->all);
    }

    public static function seoMeta(): array
    {
        return array_map(fn ($value) => '<meta name="description" content="Meta description" />', app('language')->all);
    }

    public static function multiply(array $indexes, callable $callback): array
    {
        return array_map($callback, $indexes);
    }
}
