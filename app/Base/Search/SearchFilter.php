<?php

namespace App\Base\Search;

use App\Base\Search;
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

            if (is_array($filterType)) {
                $this->processGroup(
                    group: $filterType,
                    value: $value,
                );
            } else {
                $this->processSingle(
                    filterClass: $filterType,
                    param: $param,
                    value: $value,
                );
            }
        }
    }

    private function processSingle(string $filterClass, array $param, mixed $value): void
    {
        if (count($param) == 1) {
            $filter = new $filterClass(
                query: $this->query,
                condition: Search::FILTER_CONDITION_WHERE,
                field: $param[0],
                value: $value,
            );

            $filter->process();
        } else {
            $field = array_pop($param);

            $this->applyRelation(
                query: $this->query,
                filterClass: $filterClass,
                condition: Search::FILTER_CONDITION_WHERE,
                relation: implode('.', $param),
                field: $field,
                value: $value,
            );
        }
    }

    private function processGroup(array $group, mixed $value): void
    {
        $this->query->where(function ($query) use ($group, $value) {
            foreach ($group['filters'] as $param => $filterClass) {
                $param = explode('.', $param);

                if (count($param) == 1) {
                    $filter = new $filterClass(
                        query: $query,
                        condition: $group['condition'],
                        field: $param[0],
                        value: $value,
                    );

                    $filter->process();
                } else {
                    $field = array_pop($param);

                    $this->applyRelation(
                        query: $query,
                        filterClass: $filterClass,
                        condition: $group['condition'],
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
        string $filterClass,
        string $condition,
        string $relation,
        string $field,
        mixed $value,
    ): void {
        $query->{$condition . 'Has'}(
            $relation,
            function ($query) use ($filterClass, $field, $value) {
                $filter = new $filterClass(
                    query: $query,
                    condition: Search::FILTER_CONDITION_WHERE,
                    field: $field,
                    value: $value,
                );

                $filter->process();
            }
        );
    }
}
