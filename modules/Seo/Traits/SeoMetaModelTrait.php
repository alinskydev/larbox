<?php

namespace Modules\Seo\Traits;

use Modules\Seo\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SeoMetaModelTrait
{
    public function getSeoMetaAttribute(): array
    {
        return $this->seo_meta_morph ? $this->seo_meta_morph->value : array_map(fn ($value) => null, app('language')->all);
    }

    public function getSeoMetaAsArrayAttribute(): array
    {
        if ($this->seo_meta_morph) {
            return array_map(function ($value) {
                if ($value == strip_tags($value)) return [];

                $result = [];

                $dom = new \DOMDocument();
                $dom->loadHTML($value);
                $elements = $dom->getElementsByTagName('meta');

                foreach ($elements as $key => $element) {
                    foreach ($element->attributes as $attr) {
                        $result[$key][$attr->nodeName] = $attr->nodeValue;
                    }
                }

                return $result;
            }, $this->seo_meta_morph->value);
        } else {
            return  array_map(fn ($value) => [], app('language')->all);
        }
    }

    public function seo_meta_morph(): MorphOne
    {
        return $this->morphOne(Meta::class, 'seo_metable');
    }
}
