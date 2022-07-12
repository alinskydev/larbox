<?php

namespace Modules\Section\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsBlocks implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $value = json_decode($value, true);
        $value = collect($value);

        return $value->map(function ($value, $key) {
            $object = new \stdClass();
            $object->name = $key;
            $object->value = $value;

            return $object;
        });
    }

    public function set($model, $key, $value, $attributes)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
