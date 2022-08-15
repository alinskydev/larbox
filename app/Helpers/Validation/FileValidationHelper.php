<?php

namespace App\Helpers\Validation;

class FileValidationHelper
{
    public const CONFIG_IMAGE = [
        'max' => 2048,
        'mimes' => ['jpg', 'png', 'webp', 'svg'],
    ];

    public const CONFIG_AUDIO = [
        'max' => 102400,
        'mimes' => ['mp3', 'ogg'],
    ];

    public const CONFIG_VIDEO = [
        'max' => 1024000,
        'mimes' => ['mp4'],
    ];

    public const CONFIG_DOCUMENT = [
        'max' => 2048,
        'mimes' => ['doc', 'docx', 'xls', 'xlsx', 'pdf'],
    ];

    public const CONFIG_MEDIA = [
        'max' => 1024000,
        'mimes' => [
            'jpg', 'png', 'webp', 'svg',
            'mp3', 'ogg',
            'mp4',
        ],
    ];

    public const CONFIG_ALL = [
        'max' => 1024000,
        'mimes' => [
            'jpg', 'png', 'webp', 'svg',
            'mp3', 'ogg',
            'mp4',
            'doc', 'docx', 'xls', 'xlsx', 'pdf',
        ],
    ];

    public static function rules(array $config, bool $isRequired = false)
    {
        return array_merge(
            [
                'required',
                'file',
                'mimes:' . implode(',', $config['mimes']),
                'max:' . $config['max'],
            ],
            !$isRequired ? [
                'sometimes',
            ] : [],
        );
    }
}
