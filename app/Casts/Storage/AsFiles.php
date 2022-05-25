<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Support\Arr;
use App\Helpers\FileHelper;

class AsFiles implements CastsAttributes
{
    private string $savePath;

    public function __construct(string $savePath = 'files')
    {
        $this->savePath = $savePath;
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return [];

        $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
        $value = $arrayCast->get($model, $key, $value, $attributes)->toArray();

        return array_map(fn ($v) => asset($v), $value);
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return '[]';

        if ($newFile = Arr::get($value, 'new')) {
            $oldValue = $model->getOriginal($key) ?: [];

            $value = array_map(fn ($v) => FileHelper::upload($v, $this->savePath), $newFile);
            $value = array_merge($oldValue, $value);
            $value = array_values($value);

            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            return $arrayCast->set($model, $key, $value, $attributes);
        }

        $value = array_map(fn ($v) => str_replace(asset(''), '/', $v), $value);

        $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
        return $arrayCast->set($model, $key, $value, $attributes);
    }
}
