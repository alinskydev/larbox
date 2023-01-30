<?php

namespace App\Base\Search;

use App\Base\Search\Enums\SearchFilterConditionEnum;
use App\Base\Search\Enums\SearchFilterTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    public function __construct(
        private Builder $query,
        private array $filters,
        private array $params,
    ) {
    }

    public function process(): void
    {
        foreach ($this->params as $param => $value) {
            if (!isset($this->filters[$param])) continue;

            $filterType = $this->filters[$param];
            $param = explode('.', $param);

            if ($filterType instanceof SearchFilterTypeEnum) {
                $this->processSingle(
                    filterType: $filterType,
                    param: $param,
                    value: $value,
                );
            } else {
                $this->processGroup(
                    filterGroup: $filterType,
                    value: $value,
                );
            }
        }
    }

    private function processSingle(SearchFilterTypeEnum $filterType, array $param, mixed $value): void
    {
        if (count($param) == 1) {
            $filter = new $filterType->value(
                query: $this->query,
                condition: SearchFilterConditionEnum::WHERE,
                field: $param[0],
                value: $value,
            );

            $filter->process();
        } else {
            $field = array_pop($param);

            $this->applyRelation(
                query: $this->query,
                filterType: $filterType,
                condition: SearchFilterConditionEnum::WHERE,
                relation: implode('.', $param),
                field: $field,
                value: $value,
            );
        }
    }

    private function processGroup(array $filterGroup, mixed $value): void
    {
        $this->query->where(function ($query) use ($filterGroup, $value) {
            foreach ($filterGroup['filters'] as $param => $filterType) {
                $param = explode('.', $param);

                if (count($param) == 1) {
                    $filter = new $filterType->value(
                        query: $query,
                        condition: $filterGroup['condition'],
                        field: $param[0],
                        value: $value,
                    );

                    $filter->process();
                } else {
                    $field = array_pop($param);

                    $this->applyRelation(
                        query: $query,
                        filterType: $filterType,
                        condition: $filterGroup['condition'],
                        relation: implode('.', $param),
                        field: $field,
                        value: $value,
                    );
                }
            }
        });
    }

    private function applyRelation(
        Builder $query,
        SearchFilterTypeEnum $filterType,
        SearchFilterConditionEnum $condition,
        string $relation,
        string $field,
        mixed $value,
    ): void {
        $query->{$condition->value . 'Has'}(
            $relation,
            function ($query) use ($filterType, $field, $value) {
                $filter = new $filterType->value(
                    query: $query,
                    condition: SearchFilterConditionEnum::WHERE,
                    field: $field,
                    value: $value,
                );

                $filter->process();
            }
        );
    }
}
