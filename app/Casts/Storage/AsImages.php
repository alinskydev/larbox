<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Support\Arr;
use App\Helpers\FileHelper;
use App\Helpers\ImageHelper;

class AsImages implements CastsAttributes
{
    private array $sizes = [];
    private string $savePath;

    public function __construct(string $sizes = '', string $savePath = 'images')
    {
        $this->sizes = explode('|', $sizes);
        $this->sizes = array_filter($this->sizes, fn ($f_v) => $f_v !== null);
        $this->savePath = $savePath;
    }

    public function get($model, $key, $value, $attributes): mixed
    {
        if (!$value) return [];

        $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
        $value = $arrayCast->get($model, $key, $value, $attributes)->toArray();

        return array_map(fn ($v) => ImageHelper::populateSizes($v, $this->sizes), $value);
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        if (!$value) return '[]';

        if ($newFile = Arr::get($value, 'new')) {
            $oldValue = $model->getOriginal($key) ?: [];
            $oldValue = array_map(fn ($v) => ImageHelper::clearSizes($v), $oldValue);

            $value = array_map(fn ($v) => FileHelper::upload($v, $this->savePath), $newFile);
            $value = array_merge($oldValue, $value);
            $value = array_values($value);

            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            return $arrayCast->set($model, $key, $value, $attributes);
        }

        $value = array_map(fn ($v) => ImageHelper::clearSizes($v), $value);

        $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
        return $arrayCast->set($model, $key, $value, $attributes);
    }
}
