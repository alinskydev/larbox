<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\ImageHelper;

class CastAsImage implements CastsAttributes
{
    private string $field;
    private array $sizes = [];

    public function __construct(string $field, string $sizes = '')
    {
        $this->field = $field;
        $this->sizes = explode('|', $sizes);
    }

    public function get($model, $key, $value, $attributes)
    {
        $value = $model->{$this->field};

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
