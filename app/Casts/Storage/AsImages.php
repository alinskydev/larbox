<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\ImageHelper;

class AsImages implements CastsAttributes
{
    private array $sizes = [];

    public function __construct(string $sizes = '')
    {
        $this->sizes = explode('|', $sizes);
        $this->sizes = array_filter($this->sizes, fn ($f_v) => $f_v !== null);
    }

    public function get($model, $key, $value, $attributes): mixed
    {
        if (!$value) return [];

        $value = json_decode($value, true);

        return array_map(fn ($v) => ImageHelper::populateSizes($v, $this->sizes), $value);
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
