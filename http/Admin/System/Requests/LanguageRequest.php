<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\FileValidationHelper;

class LanguageRequest extends ActiveFormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model),
            ],
            'image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }
}
