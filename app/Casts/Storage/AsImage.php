<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use App\Helpers\FileHelper;
use App\Helpers\ImageHelper;

class AsImage implements CastsAttributes
{
    private array $sizes = [];
    private string $savePath;

    public function __construct(string $sizes = '', string $savePath = 'images')
    {
        $this->sizes = explode('|', $sizes);
        $this->sizes = array_filter($this->sizes);
        $this->savePath = $savePath;
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        return ImageHelper::populateSizes($value, $this->sizes);
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($newFile = Arr::get($value, 'new')) {
            if ($oldValue = $model->getOriginal($key)) {
                $oldValue = ImageHelper::clearSizes($oldValue);
                $oldValue = str_replace(asset(''), '', $oldValue);
                $oldValue = public_path($oldValue);
                File::delete($oldValue);
            }

            return FileHelper::upload($newFile, $this->savePath);
        }

        return ImageHelper::clearSizes($value);
    }
}
