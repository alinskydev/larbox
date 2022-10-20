<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\HtmlCleanHelper;
use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
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

    protected function nonLocalizedRules()
    {
        return [];
    }

    protected function localizedRules()
    {
        return [];
    }

    final public function rules(): array
    {
        $rules = $this->nonLocalizedRules();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $rules += $this->seoMetaRules();
        }

        $languages = app('language')->all;

        foreach ($this->localizedRules() as $key => $rule) {
            foreach ($languages as $language) {
                $rules[$key . '.' . $language['code']] = $rule;
            }
        }

        return $rules;
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

            $rawData = array_filter($rawData, fn ($f_v) => $f_v !== null);

            $data = HtmlCleanHelper::process(
                data: $data,
                type: $this->fieldCleanType,
            );

            $data = array_replace_recursive($data, $rawData);
        }

        $this->merge($data);
    }

    protected function saveFiles(array $data, string $path = 'files'): array
    {
        $data = Arr::dot($data);

        foreach ($data as &$value) {
            if ($value instanceof UploadedFile) {
                $value = FileHelper::upload($value, $path);
            }
        }

        $data = Arr::undot($data);

        return $data;
    }
}
