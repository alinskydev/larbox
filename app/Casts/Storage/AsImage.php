<?php

namespace App\Casts\Storage;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\FileHelper;
use App\Helpers\ImageHelper;

class AsImage implements CastsAttributes
{
    private array $sizes = [];

    public function __construct(string $sizes)
    {
        $this->sizes = explode('|', $sizes);
        $this->sizes = array_filter($this->sizes, fn ($f_v) => $f_v !== null);
    }

    public function get($model, $key, $value, $attributes): mixed
    {
        if (!$value) return null;

        return ImageHelper::populateSizes($value, $this->sizes);
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        if (!$value) return null;

        $oldValue = $model->getRawOriginal($key);

        if ($oldValue) FileHelper::delete(public_path($oldValue));

        return $value;
    }
}
