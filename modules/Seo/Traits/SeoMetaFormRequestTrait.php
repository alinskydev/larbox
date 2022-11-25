<?php

namespace Modules\Seo\Traits;

trait SeoMetaFormRequestTrait
{
    protected function seoMetaRules()
    {
        return [
            'seo_meta' => 'present|nullable|string',
        ];
    }
}
