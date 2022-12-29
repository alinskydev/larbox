<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\FileHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Arr;

class AsImages implements CastsAttributes
{
    private array $sizes = [];

    public function __construct(string $sizes)
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
        $oldValue = $model->getRawOriginal($key);
        $oldValue = json_decode($oldValue, true) ?? [];

        if (isset($value['old_keys']) && isset($value['new_files'])) {
            $undeletedOldValue = Arr::only($oldValue, $value['old_keys']);
            $undeletedOldValue = array_replace(array_flip($value['old_keys']), $undeletedOldValue);

            $oldValue = array_diff($oldValue, $undeletedOldValue);
            $value = array_merge($undeletedOldValue, $value['new_files']);
        }

        foreach ($oldValue as $file) {
            FileHelper::delete(public_path($file));
        }

        $value = array_values($value);
        $value = json_encode($value);

        return $value;
    }
}
