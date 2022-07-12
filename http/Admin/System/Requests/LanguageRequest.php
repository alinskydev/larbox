<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;
use App\Helpers\Validation\FileValidationHelper;

class LanguageRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'image',
    ];

    public function nonLocalizedRules()
    {
        return [
            'name' => 'required|string|max:100',
            'image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }
}
