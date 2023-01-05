<?php

namespace Modules\Seo\Traits;

use Modules\Seo\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SeoMetaModelTrait
{
    public function getSeoMetaAttribute(): array
    {
        return $this->seo_meta_morph->value ?? array_map(fn ($value) => null, app('language')->all);
    }

    public function getSeoMetaAsArrayAttribute(): array
    {
        return $this->seo_meta_morph->value_as_array ?? array_map(fn ($value) => [], app('language')->all);
    }

    public function seo_meta_morph(): MorphOne
    {
        return $this->morphOne(Meta::class, 'seo_metable');
    }
}
