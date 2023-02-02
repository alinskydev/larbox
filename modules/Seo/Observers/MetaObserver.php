<?php

namespace Modules\Seo\Observers;

use Modules\Seo\Models\Meta;

class MetaObserver
{
    public function saving(Meta $model): void
    {
        if ($model->value) {
            $model->value_as_array = array_map(function ($value) {
                if (!$value || $value === strip_tags($value)) return [];

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
            }, $model->value);
        } else {
            $model->value_as_array = array_map(fn ($value) => [], app('language')->all);
        }
    }
}
