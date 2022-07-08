<?php

namespace App\Helpers\Validation;

class FileValidationHelper
{
    const CONFIG_IMAGE = [
        'max' => 2048,
        'mimes' => ['jpg', 'png', 'webp', 'svg'],
    ];

    const CONFIG_AUDIO = [
        'max' => 102400,
        'mimes' => ['mp3', 'ogg'],
    ];

    const CONFIG_VIDEO = [
        'max' => 1024000,
        'mimes' => ['mp4'],
    ];

    const CONFIG_DOCUMENT = [
        'max' => 2048,
        'mimes' => ['doc', 'docx', 'xls', 'xlsx', 'pdf'],
    ];

    const CONFIG_MEDIA = [
        'max' => 1024000,
        'mimes' => [
            'jpg', 'png', 'webp', 'svg',
            'mp3', 'ogg',
            'mp4',
        ],
    ];

    const CONFIG_ALL = [
        'max' => 1024000,
        'mimes' => [
            'jpg', 'png', 'webp', 'svg',
            'mp3', 'ogg',
            'mp4',
            'doc', 'docx', 'xls', 'xlsx', 'pdf',
        ],
    ];

    public static function rules(array $config, array $extraRules = [])
    {
        return array_merge(
            [
                'sometimes',
                'required',
                'file',
                'mimes:' . implode(',', $config['mimes']),
                'max:' . $config['max'],
            ],
            $extraRules
        );
    }
}
