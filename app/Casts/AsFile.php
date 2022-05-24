<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class AsFile implements CastsAttributes
{
    public function __construct(
        private bool $isMultiple,
    ) {
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($this->isMultiple) {
            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            $value = $arrayCast->get($model, $key, $value, $attributes)->toArray();

            return array_map(fn ($v) => asset($v), $value);
        } else {
            return asset($value);
        }
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($this->isMultiple) {
            $value = array_map(fn ($v) => str_replace(asset(''), '/', $v), $value);

            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            return $arrayCast->set($model, $key, $value, $attributes);
        } else {
            return str_replace(asset(''), '/', $value);
        }
    }
}
