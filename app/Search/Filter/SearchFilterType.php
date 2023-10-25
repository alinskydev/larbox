<?php

namespace App\Search\Filter;

use App\Search\Enums\SearchFilterConditionEnum;
use Illuminate\Database\Eloquent\Builder;

abstract class SearchFilterType
{
    protected string $condition;

    public function __construct(
        protected Builder $query,
        protected string $field,
        protected mixed $value,
        SearchFilterConditionEnum $condition,
    ) {
        $this->condition = $condition->value;
    }

    abstract public function process(): void;
}
