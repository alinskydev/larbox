<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use App\Helpers\HtmlCleanHelper;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    protected array $uncleanedFields = [];
    protected array $fileFields = [];

    protected string $fieldCleanType = 'purify';

    public function __construct()
    {
        $this->uncleanedFields = array_merge($this->uncleanedFields, array_keys($this->fileFields));
        return parent::__construct();
    }

    public function attributes()
    {
        $rulesKeys = array_keys($this->rules());

        $attributes = array_combine($rulesKeys, $rulesKeys);
        $attributes = array_map(fn ($value) => __("field.$value"), $attributes);

        return $attributes;
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $data = parent::validationData();

        if ($this->fieldCleanType != HtmlCleanHelper::TYPE_NONE) {
            $newData = $data;

            Arr::forget($newData, $this->uncleanedFields);

            $newData = HtmlCleanHelper::process(
                data: $newData,
                type: $this->fieldCleanType,
            );

            $data = array_replace_recursive($data, $newData);
        }

        $this->merge($data);
    }
}
