<?php

namespace Modules\Seo\Traits;

use Illuminate\Support\Arr;

trait SeoMetaFormRequestTrait
{
    protected function seoMetaRules()
    {
        $rules = [];

        $languages = app('language')->all;

        $seoMetaRules = [
            'seo_meta' => 'present|nullable|string',
        ];

        foreach ($seoMetaRules as &$rule) {
            $rule = data_set($languages, '*', $rule);
        }

        $rules += Arr::dot($seoMetaRules);

        return $rules;
    }
}
