<?php

namespace App\Base;

use App\Base\Search\SearchFilter;
use App\Base\Search\SearchSort;
use App\Base\Search\SearchShow;
use App\Base\Search\Filter\Types as FilterTypes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class Search
{
    public const FILTER_CLASS_BETWEEN_DATE = FilterTypes\BetweenDate::class;
    public const FILTER_CLASS_BETWEEN_DATETIME = FilterTypes\BetweenDatetime::class;
    public const FILTER_CLASS_BETWEEN_NUMBER = FilterTypes\BetweenNumber::class;
    public const FILTER_CLASS_DATE = FilterTypes\Date::class;
    public const FILTER_CLASS_DATETIME = FilterTypes\Datetime::class;
    public const FILTER_CLASS_EQUAL_RAW = FilterTypes\EqualRaw::class;
    public const FILTER_CLASS_EQUAL_STRING = FilterTypes\EqualString::class;
    public const FILTER_CLASS_IN = FilterTypes\In::class;
    public const FILTER_CLASS_JSON_CONTAINS_ALL = FilterTypes\JsonContainsAll::class;
    public const FILTER_CLASS_JSON_CONTAINS_ANY = FilterTypes\JsonContainsAny::class;
    public const FILTER_CLASS_LIKE = FilterTypes\Like::class;
    public const FILTER_CLASS_LOCALIZED_LIKE = FilterTypes\LocalizedLike::class;

    public const FILTER_CONDITION_WHERE = 'where';
    public const FILTER_CONDITION_OR_WHERE = 'orWhere';

    public const SORT_TYPE_RAW = 'sortRaw';
    public const SORT_TYPE_LOCALIZED = 'sortLocalized';

    public Builder $query;

    public array $relations = [];
    public array $filters = [];
    public array $sortings = [];

    public array $defaultSort = ['-id'];
    public int $pageSize = 50;

    public function setQuery(Builder $query): static
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
}
