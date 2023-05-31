<?php

namespace App\Search\Filter;

use App\Base\QueryBuilder;
use App\Search\Enums\SearchFilterConditionEnum;

abstract class SearchFilterType
{
    protected string $condition;

    public function __construct(
        protected QueryBuilder $query,
        protected string $field,
        protected mixed $value,
        SearchFilterConditionEnum $condition,
    ) {
        $this->condition = $condition->value;
    }

    abstract public function process(): void;
}
