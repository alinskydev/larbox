<?php

namespace App\Casts\Date;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsDatetime implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): mixed
    {
        return $value;
    }

    public function set($model, $key, $value, $attributes): mixed
    {
        return $value ? date('Y-m-d H:i:s', strtotime($value)) : null;
    }
}
