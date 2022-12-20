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

            // Deleting old files

            $nonDeletedOldValue = Arr::only($oldValue, $value['old_keys']);
            $nonDeletedOldValue = array_replace(array_flip($value['old_keys']), $nonDeletedOldValue);

            $filesForDelete = array_diff($oldValue, $nonDeletedOldValue);
            foreach ($filesForDelete as $file) FileHelper::delete(public_path($file));

            // Adding new files

            $newValue = array_merge($nonDeletedOldValue, $value['new_files']);
            $newValue = array_values($newValue);
        } else {

            // Merging old and new files

            $newValue = array_merge($oldValue, $value);
            $newValue = array_values($newValue);
        }

        return json_encode($newValue);
    }
}
