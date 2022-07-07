<?php

namespace App\Helpers;

class FormRequestHelper
{
    public static function fileRules(
        string $mimes = LARBOX_VALIDATION_FILE_MIMES_ALL,
        int $max = LARBOX_VALIDATION_FILE_SIZE_ALL,
        array $extraRules = [],
    ) {
        return array_merge(
            [
                'sometimes',
                'required',
                'file',
                "mimes:$mimes",
                "max:$max",
            ],
            $extraRules
        );
    }

    public static function mediaRules(
        string $mimes = LARBOX_VALIDATION_FILE_MIMES_MEDIA,
        int $max = LARBOX_VALIDATION_FILE_SIZE_MEDIA,
        array $extraRules = [],
    ) {
        return array_merge(
            [
                'sometimes',
                'required',
                'file',
                "mimes:$mimes",
                "max:$max",
            ],
            $extraRules
        );
    }

    public static function imageRules(
        string $mimes = LARBOX_VALIDATION_FILE_MIMES_IMAGE,
        int $max = LARBOX_VALIDATION_FILE_SIZE_IMAGE,
        array $extraRules = [],
    ) {
        return array_merge(
            [
                'sometimes',
                'required',
                'file',
                "mimes:$mimes",
                "max:$max",
            ],
            $extraRules
        );
    }
}
