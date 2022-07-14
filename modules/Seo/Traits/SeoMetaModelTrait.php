<?php

namespace Modules\Seo\Traits;

use Modules\Seo\Models\Meta;

trait SeoMetaModelTrait
{
    public function getSeoMetaAttribute()
    {
        return $this->seo_meta_morph ?? [];
    }

    public function seo_meta_morph()
    {
        return $this->morphOne(Meta::class, 'seo_metable');
    }
}
