<?php

namespace App\Helpers\Validation;

class ValidationFileRulesHelper
{
    public static function image(): array
    {
        return self::generate(
            max: 1024 * 2,
            mimes: ['jpg', 'png', 'webp', 'svg'],
        );
    }

    public static function media(): array
    {
        return self::generate(
            max: 1024 * 100,
            mimes: [
                'jpg', 'png', 'webp', 'svg',
                'mp3', 'ogg',
                'mp4',
            ],
        );
    }

    public static function document(): array
    {
        return self::generate(
            max: 1024 * 10,
            mimes: ['doc', 'docx', 'xls', 'xlsx', 'pdf'],
        );
    }

    private static function generate(int $max, array $mimes): array
    {
        return [
            'file',
            'mimes:' . implode(',', $mimes),
            "max:$max",
        ];
    }
}
