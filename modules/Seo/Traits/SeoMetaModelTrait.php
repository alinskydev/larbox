<?php

namespace Modules\Seo\Traits;

use Modules\Seo\Models\Meta;

trait SeoMetaModelTrait
{
    public function getSeoMetaAttribute()
    {
        $languages = app('language')->all;

        return $this->seo_meta_morph ?? [
            'head' => array_map(fn ($value) => null, $languages),
        ];
    }

    public function getSeoMetaAsArrayAttribute()
    {
        if ($this->seo_meta_morph) {
            $head = array_map(function ($value) {
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
            }, $this->seo_meta_morph['head']);

            return ['head' => $head];
        } else {
            $languages = app('language')->all;

            return  [
                'head' => array_map(fn ($value) => [], $languages),
            ];
        }
    }

    public function seo_meta_morph()
    {
        return $this->morphOne(Meta::class, 'seo_metable');
    }
}
