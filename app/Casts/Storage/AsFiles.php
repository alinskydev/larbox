<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsFiles implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): mixed
    {
        if (!$value) return [];

        $value = json_decode($value, true);

        return array_map(fn ($v) => asset($v), $value);
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        if (!$value) return '[]';

        $oldValue = $model->getRawOriginal($key);
        $oldValue = json_decode($oldValue, true) ?? [];

        $value = array_merge($oldValue, $value);
        $value = array_values($value);

        return json_encode($value);
    }
}
