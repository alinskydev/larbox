<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\FileHelper;

class AsFile implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): mixed
    {
        if (!$value) return null;

        return asset($value);
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        $oldValue = $model->getRawOriginal($key);

        if ($oldValue && $value != $oldValue) FileHelper::delete(public_path($oldValue));

        return $value;
    }
}
