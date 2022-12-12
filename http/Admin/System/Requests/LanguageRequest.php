<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\ValidationFileHelper;

class LanguageRequest extends ActiveFormRequest
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
                ),
            ],
            'image' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
        ];
    }
}
