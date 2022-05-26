<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;
use App\Helpers\FormRequestHelper;

class LanguageRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'image',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'image' => FormRequestHelper::imageRules(),
        ];
    }
}
