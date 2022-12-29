<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\FileHelper;
use Illuminate\Support\Arr;

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
