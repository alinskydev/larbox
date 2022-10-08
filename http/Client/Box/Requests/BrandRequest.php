<?php

namespace Http\Client\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\FileValidationHelper;

class BrandRequest extends ActiveFormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model, false),
            ],
            'show_on_the_home_page' => 'required|boolean',
            'file' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
            'files_list' => 'array',
            'files_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
        ];
    }
}
