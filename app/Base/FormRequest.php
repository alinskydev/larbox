<?php

namespace App\Base;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use App\Helpers\HtmlPurifierHelper;
use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FormRequest extends BaseFormRequest
{
    public array $validatedData;

    protected array $defaults = [];
    protected array $filesSavePaths = [];

    public function attributes(): array
    {
        $languagesCodes = Arr::pluck(app('language')->all, 'code');
        $languagesRegex = implode('|', $languagesCodes);
        $languagesRegex = "/\.($languagesRegex)$/";

        $attributes = array_keys($this->rules());
        $attributes = array_combine($attributes, $attributes);

        $attributes = array_map(function ($value) use ($languagesRegex) {
            $value = preg_replace($languagesRegex, '', $value);
            return __("fields.$value");
        }, $attributes);

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

    public function rules(): array
    {
        $rules = $this->nonLocalizedRules();

        $localizedRules = $this->localizedRules();
        $locales = array_keys(app('language')->all);

        foreach ($localizedRules as $key => $rule) {
            foreach ($locales as $locale) {
                $rules["$key.$locale"] = $rule;
            }
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        $data = parent::validationData();
        $data = HtmlPurifierHelper::process($data);

        $this->merge($data);
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        if (method_exists($this, 'additionalValidation')) {
            $this->additionalValidation();

            if ($this->validator->errors()->messages()) {
                $this->failedValidation($this->validator);
            }
        }

        $this->validatedData = $this->validated();
        $this->saveFiles();

        foreach ($this->defaults as $field => $value) {
            data_fill($this->validatedData, $field, $value);
        }
    }

    private function saveFiles(): void
    {
        $this->validatedData = Arr::dot($this->validatedData);

        foreach ($this->validatedData as $key => &$value) {
            if (!($value instanceof UploadedFile)) continue;

            $savePath = 'files';

            foreach ($this->filesSavePaths as $field => $fieldPath) {
                if (Str::is($field, $key)) {
                    $savePath = $fieldPath;
                    break;
                }
            }

            $value = FileHelper::upload($value, $savePath);
        }

        $this->validatedData = Arr::undot($this->validatedData);
    }
}
