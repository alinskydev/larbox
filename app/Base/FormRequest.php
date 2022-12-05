<?php

namespace App\Base;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\HtmlCleanHelper;
use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FormRequest extends BaseFormRequest
{
    protected string $fieldCleanType = HtmlCleanHelper::TYPE_PURIFY;

    protected array $defaults = [];
    protected array $filesSavePaths = [];

    public array $validatedData;

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

        if (
            property_exists($this, 'model') &&
            $this->model instanceof Model &&
            $this->model->exists
        ) {
            if (
                $this->updated_at &&
                $this->updated_at != date(LARBOX_FORMAT_DATETIME, strtotime($this->model->updated_at))
            ) {
                abort(409, __('Данные были изменены другим источником. Обновите страницу, чтобы увидеть изменения.'));
            }
        }

        $data = parent::validationData();
        $data = HtmlCleanHelper::process($data, $this->fieldCleanType);

        $this->merge($data);
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $this->validatedData = $this->validated();
        $this->saveFiles();

        foreach ($this->defaults as $field => $value) {
            data_fill($this->validatedData, $field, $value);
        }

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $this->model->fillableRelations[$this->model::RELATION_TYPE_ONE_ONE]['seo_meta_morph'] = [
                'value' => Arr::pull($this->validatedData, 'seo_meta'),
            ];
        }
    }

    protected function saveFiles(): void
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
