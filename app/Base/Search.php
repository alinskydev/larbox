<?php

namespace App\Base;

use App\Search\SearchFilter;
use App\Search\SearchSort;
use App\Search\SearchShow;

use Illuminate\Support\Arr;

class Search
{
    public QueryBuilder $query;

    public array $relations = [];
    public array $filters = [];
    public array $sortings = [];

    public array $defaultSort = ['-id'];
    public int $pageSize = 50;

    public function setQuery(QueryBuilder $query): static
    {
        $this->query = $query;
        return $this;
    }

    public function with(array $params): static
    {
        $params = Arr::flatten($params);
        $params = array_intersect($params, $this->relations);

        $this->query->with($params);

        return $this;
    }

    public function filter(array $params): static
    {
        $filter = new SearchFilter(
            query: $this->query,
            filters: $this->filters,
            params: $params,
        );

        $filter->process();

        return $this;
    }

    public function sort(array $params): static
    {
        $params = Arr::flatten($params) ?: $this->defaultSort;

        $sorter = new SearchSort(
            query: $this->query,
            sortings: $this->sortings,
            params: $params,
        );

        $sorter->process();

        return $this;
    }

    public function show(array $params): static
    {
        $params = Arr::flatten($params);

        $shower = new SearchShow(
            query: $this->query,
            params: $params,
        );

        $shower->process();

        return $this;
    }

    public function setPageSize(int $pageSize): static
    {
        if ($pageSize > 0 && $pageSize <= $this->pageSize) {
            $this->pageSize = $pageSize;
        }

        return $this;
    }

    public function extraQuery(): static
    {
        return $this;
    }
}
