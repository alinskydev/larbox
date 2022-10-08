<?php

namespace Modules\Seo\Traits;

use Modules\Seo\Models\Meta;

trait SeoMetaModelTrait
{
    public function getSeoMetaAttribute()
    {
        $languages = app('language')->all->toArray();

        return $this->seo_meta_morph ?? [
            'head' => array_map(fn ($value) => '', $languages),
        ];
    }

    public function seo_meta_morph()
    {
        return $this->morphOne(Meta::class, 'seo_metable');
    }
}
