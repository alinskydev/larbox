<?php

namespace Modules\Seo\Traits;

trait SeoMetaFormRequestTrait
{
    protected function seoMetaRules(): array
    {
        return [
            'seo_meta' => 'present|nullable|string',
        ];
    }
}
