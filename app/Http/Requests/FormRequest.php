<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use App\Helpers\HtmlCleanHelper;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    protected array $rawFields = [];

    protected string $fieldCleanType = 'purify';

    public function attributes()
    {
        $rulesKeys = array_keys($this->rules());

        $attributes = array_combine($rulesKeys, $rulesKeys);
        $attributes = array_map(fn ($value) => __("fields.$value"), $attributes);

        return $attributes;
    }

    public function nonLocalizedRules()
    {
        return [];
    }

    public function localizedRules()
    {
        return [];
    }

    public function rules()
    {
        $languages = app('language')->active->toArray();

        $localizedRules = $this->localizedRules();

        foreach ($localizedRules as &$rule) {
            $rule = data_set($languages, '*', $rule);
        }

        $localizedRules = Arr::dot($localizedRules);

        return array_merge($this->nonLocalizedRules(), $localizedRules);
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $data = parent::validationData();

        if ($this->fieldCleanType != HtmlCleanHelper::TYPE_NONE) {
            $rawData = [];

            foreach ($this->rawFields as $field) {
                $rawData[$field] = Arr::get($data, $field);
            }

            $rawData = array_filter($rawData);

            $data = HtmlCleanHelper::process(
                data: $data,
                type: $this->fieldCleanType,
            );

            $data = array_replace_recursive($data, $rawData);
        }

        $this->merge($data);
    }
}
