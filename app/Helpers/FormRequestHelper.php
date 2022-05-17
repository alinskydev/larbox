<?php

namespace App\Helpers;

use App\Services\LocalizationService;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class FormRequestHelper
{
    public static function slug(?string $value, mixed $altValue, bool $isLocalized = true)
    {
        if ($isLocalized) {
            $altValue = Arr::get($altValue, app()->getLocale());
        }

        return Str::slug($value ?: $altValue);
    }

    public static function createLocalizationRules(array $rules)
    {
        $languages = LocalizationService::getInstance()->activeLanguages->toArray();

        foreach ($rules as &$rule) {
            $rule = data_set($languages, '*', $rule);
        }

        return Arr::dot($rules);
    }
}
