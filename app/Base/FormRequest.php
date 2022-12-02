<?php

namespace App\Base;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\HtmlCleanHelper;
use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    protected string $fieldCleanType = HtmlCleanHelper::TYPE_PURIFY;

    public function attributes(): array
    {
        $attributes = array_keys($this->nonLocalizedRules());
        $attributes = array_combine($attributes, $attributes);

        $languages = app('language')->all;

        $localizedAttributes = array_keys($this->localizedRules());

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $localizedAttributes = array_merge(
                $localizedAttributes,
                array_keys($this->seoMetaRules()),
            );
        }

        foreach ($localizedAttributes as $l_a) {
            foreach ($languages as $language) {
                $attributes[$l_a . '.' . $language['code']] = $l_a;
            }
        }

        $attributes = array_map(fn ($value) => __("fields.$value"), $attributes);

        return $attributes;
    }

    protected function nonLocalizedRules(): array
    {
        return [];
    }

    protected function localizedRules(): array
    {
        return [];
    }

    final public function rules(): array
    {
        $rules = $this->nonLocalizedRules();

        $languages = app('language')->all;

        $localizedRules = $this->localizedRules();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $localizedRules = array_merge(
                $localizedRules,
                $this->seoMetaRules(),
            );
        }

        foreach ($localizedRules as $key => $rule) {
            foreach ($languages as $language) {
                $rules[$key . '.' . $language['code']] = $rule;
            }
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        $data = parent::validationData();
        $data = HtmlCleanHelper::process($data, $this->fieldCleanType);

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
