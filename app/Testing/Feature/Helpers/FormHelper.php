<?php

namespace App\Testing\Feature\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Testing\File;

class FormHelper
{
    public static function localized(string $string): array
    {
        return array_map(fn ($value) => "$string " . $value['code'], app('language')->all);
    }

    public static function files(
        string $name = 'image.jpg',
        string $mime = 'image/jpeg',
        int $size = 100,
        int $quantity = 1,
    ): File|array {
        if ($quantity === 1) {
            return UploadedFile::fake()->create($name, $size, $mime);
        } else {
            return array_map(fn ($value) => UploadedFile::fake()->create($name, $size, $mime), range(1, $quantity));
        }
    }

    public static function deleteableFiles(
        string $field,
        File|array $files,
        array $oldKeys = [],
    ): array {
        return [
            $field => $files,
            "{$field}_old_keys" => json_encode($oldKeys),
        ];
    }

    public static function seoMeta(): array
    {
        return [
            'seo_meta' => array_map(
                fn ($value) => '<meta name="description" content="Description" />',
                app('language')->all,
            ),
        ];
    }
}
