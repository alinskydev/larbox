<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use App\Helpers\HtmlHelper;

class FormRequest extends BaseFormRequest
{
    protected array $fileFields = [];
    protected array $unpurifiedFields = [];
    
    protected string $fieldCleanType = 'purify';

    public function attributes()
    {
        $rulesKeys = array_keys($this->rules());

        $attributes = array_combine($rulesKeys, $rulesKeys);
        $attributes = array_map(fn ($value) => __("fields.$value"), $attributes);

        return $attributes;
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $purifiedData = HtmlHelper::clean(
            data: $this->validationData(),
            ignoredFields: $this->unpurifiedFields,
            type: $this->fieldCleanType,
        );

        $this->merge($purifiedData);
    }
}
