<?php

namespace App\Tests\Feature\Helpers;

use Illuminate\Http\UploadedFile;

class FormHelper
{
    public static function localized(string $string)
    {
        $languages = app('language')->active->toArray();
        return array_map(fn ($value) => "$string " . $value['code'], $languages);
    }

    public static function file(
        string $name = 'image.jpg',
        int $size = 100,
        string $mime = 'image/jpeg',
    ) {
        return UploadedFile::fake()->create($name, $size, $mime);
    }

    public static function seoMeta()
    {
        return [
            'head' => [
                'ru' => 'Meta ru',
                'uz' => 'Meta uz',
                'en' => 'Meta en',
            ],
        ];
    }

    public static function multiply(array $indexes, callable $callback)
    {
        return array_map($callback, $indexes);
    }
}
