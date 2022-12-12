<?php

namespace Http\Website\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\ValidationFileHelper;

class BrandRequest extends ActiveFormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: false,
                    showDetailedErrorMessage: false,
                ),
            ],
            'show_on_the_home_page' => 'required|boolean',
            'file' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_ALL),
            'files_list' => 'array',
            'files_list.*' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_ALL),
        ];
    }
}
