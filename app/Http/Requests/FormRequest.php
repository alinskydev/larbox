<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use App\Helpers\HtmlCleanHelper;
use App\Services\LocalizationService;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    protected array $uncleanedFields = [];
    protected array $fileFields = [];

    protected string $fieldCleanType = 'purify';

    public function __construct()
    {
        $this->uncleanedFields = array_merge($this->uncleanedFields, $this->fileFields);
        return parent::__construct();
    }

    public function attributes()
    {
        $rulesKeys = array_keys($this->rules());

        $attributes = array_combine($rulesKeys, $rulesKeys);
        $attributes = array_map(fn ($value) => __("field.$value"), $attributes);

        return $attributes;
    }

    public function classicRules()
    {
        return [];
    }

    public function localizedRules()
    {
        return [];
    }

    public function rules()
    {
        $languages = LocalizationService::getInstance()->activeLanguages->toArray();

        $localizedRules = $this->localizedRules();

        foreach ($localizedRules as &$rule) {
            $rule = data_set($languages, '*', $rule);
        }

        $localizedRules = Arr::dot($localizedRules);

        return array_merge($this->classicRules(), $localizedRules);
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
