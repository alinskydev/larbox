<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    abstract public function process(Builder $query): Builder;
}
