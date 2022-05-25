<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use App\Helpers\FileHelper;

class AsFile implements CastsAttributes
{
    private string $savePath;

    public function __construct(string $savePath = 'files')
    {
        $this->savePath = $savePath;
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        return asset($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($newFile = Arr::get($value, 'new')) {
            if ($oldValue = $model->getOriginal($key)) {
                $oldValue = str_replace(asset(''), '', $oldValue);
                $oldValue = public_path($oldValue);
                File::delete($oldValue);
            }

            return FileHelper::upload($newFile, $this->savePath);
        }

        return str_replace(asset(''), '/', $value);
    }
}
