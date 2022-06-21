<?php

namespace App\Casts\Date;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsDate implements CastsAttributes
{
    public function __construct(
        public string $format = LARBOX_FORMAT_DATE,
    ) {
    }

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        return date($this->format, strtotime($value));
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value) return null;

        return date('Y-m-d', strtotime($value));
    }
}
