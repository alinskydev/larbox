<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;
use App\Helpers\Validation\FileValidationHelper;

class LanguageRequest extends ActiveFormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'name' => 'required|string|max:255',
            'image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }
}
