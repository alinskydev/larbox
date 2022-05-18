<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\ImageHelper;

class CastAsImage implements CastsAttributes
{
    private array $sizes = [];

    public function __construct(string $sizes = '')
    {
        $this->sizes = explode('|', $sizes);
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        $result = [
            'original' => asset($value),
        ];

        foreach ($this->sizes as $size) {
            $result["w_$size"] = ImageHelper::thumbnail($value, 'widen', [$size]);
        }

        return $result;
    }

    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
