<?php

namespace App\Base\Search\Filter;

use Illuminate\Database\Eloquent\Builder;

abstract class SearchFilterType
{
    public function __construct(
        protected Builder $query,
        protected string $condition,
        protected string $field,
        protected mixed $value,
    ) {
    }

    abstract public function process(): void;
}
