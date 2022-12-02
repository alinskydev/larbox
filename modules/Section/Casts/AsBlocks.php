<?php

namespace Modules\Section\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsBlocks implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): mixed
    {
        $value = json_decode($value, true);
        $value = collect($value);

        if (!in_array($model->name, ['layout'])) {
            $value->put('seo_meta', $model->seo_meta);
            $value->put('seo_meta_as_array', $model->seo_meta_as_array);
        }

        return $value->map(function ($value, $key) {
            $object = new \stdClass();
            $object->name = $key;
            $object->value = $value;

            return $object;
        })->sortKeys();
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
