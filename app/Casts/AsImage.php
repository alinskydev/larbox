<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Helpers\ImageHelper;

class AsImage implements CastsAttributes
{
    private bool $isMultiple;
    private array $sizes = [];

    public function __construct(bool $isMultiple, string $sizes = '')
    {
        $this->isMultiple = $isMultiple;
        $this->sizes = explode('|', $sizes);
        $this->sizes = array_filter($this->sizes);
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($this->isMultiple) {
            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            $value = $arrayCast->get($model, $key, $value, $attributes)->toArray();

            return array_map(fn ($v) => $this->setSizes($v), $value);
        } else {
            return $this->setSizes($value);
        }
    }

    private function setSizes(string $url)
    {
        $result = [
            'original' => asset($url),
        ];

        foreach ($this->sizes as $size) {
            $result["w_$size"] = ImageHelper::thumbnail($url, 'widen', [$size]);
        }

        return $result;
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        if ($this->isMultiple) {
            $value = array_map(fn ($v) => is_array($v) ? $this->removeSizes($v) : $v, $value);

            $arrayCast = AsArrayObject::castUsing([$model, $key, $value, $attributes]);
            return $arrayCast->set($model, $key, $value, $attributes);
        } else {
            return is_array($value) ? $this->removeSizes($value) : $value;
        }
    }

    private function removeSizes(array $urls)
    {
        $result = $urls['original'];
        return str_replace(asset(''), '/', $result);
    }
}