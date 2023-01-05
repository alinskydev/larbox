<?php

namespace App\Helpers\Validation;

class ValidationFileRulesHelper
{
    public static function image(bool $isRequired = false): array
    {
        return self::generate(
            max: 1024 * 2,
            mimes: ['jpg', 'png', 'webp', 'svg'],
            isRequired: $isRequired,
        );
    }

    public static function media(bool $isRequired = false): array
    {
        return self::generate(
            max: 1024 * 100,
            mimes: [
                'jpg', 'png', 'webp', 'svg',
                'mp3', 'ogg',
                'mp4',
            ],
            isRequired: $isRequired,
        );
    }

    public static function document(bool $isRequired = false): array
    {
        return self::generate(
            max: 1024 * 10,
            mimes: ['doc', 'docx', 'xls', 'xlsx', 'pdf'],
            isRequired: $isRequired,
        );
    }

    private static function generate(int $max, array $mimes, bool $isRequired): array
    {
        return [
            'file',
            'mimes:' . implode(',', $mimes),
            "max:$max",
            $isRequired ? 'required' : null,
        ];
    }
}
