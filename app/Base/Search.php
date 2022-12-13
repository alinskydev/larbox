<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

use App\Base\Search\Filter\Types as FilterTypes;

class Search
{
    public const FILTER_TYPE_BETWEEN_DATE = FilterTypes\BetweenDate::class;
    public const FILTER_TYPE_BETWEEN_DATETIME = FilterTypes\BetweenDatetime::class;
    public const FILTER_TYPE_BETWEEN_NUMBER = FilterTypes\BetweenNumber::class;
    public const FILTER_TYPE_DATE = FilterTypes\Date::class;
    public const FILTER_TYPE_DATETIME = FilterTypes\Datetime::class;
    public const FILTER_TYPE_EQUAL_RAW = FilterTypes\EqualRaw::class;
    public const FILTER_TYPE_EQUAL_STRING = FilterTypes\EqualString::class;
    public const FILTER_TYPE_IN = FilterTypes\In::class;
    public const FILTER_TYPE_JSON_CONTAINS_ALL = FilterTypes\JsonContainsAll::class;
    public const FILTER_TYPE_JSON_CONTAINS_ANY = FilterTypes\JsonContainsAny::class;
    public const FILTER_TYPE_LIKE = FilterTypes\Like::class;
    public const FILTER_TYPE_LOCALIZED_LIKE = FilterTypes\LocalizedLike::class;

    public const COMBINED_FILTER_TYPE_ALL = 'where';
    public const COMBINED_FILTER_TYPE_ANY = 'orWhere';

    public const SORT_TYPE_SIMPLE = 'sortTypeSimple';
    public const SORT_TYPE_LOCALIZED = 'sortTypeLocalized';

    public Builder $query;

    public array $relations = [];
    public array $filters = [];
    public array $combinedFilters = [];
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

    public function filter(array $params, string $combinedType, ?Builder $query = null): static
    {
        $query = $query ?? $this->query;

        foreach ($params as $param => $value) {
            if (!isset($this->filters[$param])) continue;

            $type = $this->filters[$param];
            $param = explode('.', $param);

            if (count($param) == 1) {
                $filter = new $type(
                    query: $query,
                    condition: $combinedType,
                    field: $param[0],
                    value: $value,
                );

                $filter->process();
            } else {
                $field = array_pop($param);

                $query->{$combinedType . 'Has'}(
                    implode('.', $param),
                    function ($subQuery) use ($field, $type, $value) {
                        $subQuery->select('id');

                        $filter = new $type(
                            query: $subQuery,
                            condition: self::COMBINED_FILTER_TYPE_ALL,
                            field: $field,
                            value: $value,
                        );

                        $filter->process();
                    }
                );
            }
        }

        return $this;
    }

    public function combinedFilter(array $params): static
    {
        foreach ($params as $param => $value) {
            $options = $this->combinedFilters[$param] ?? null;

            if (!$options) continue;

            $fields = array_map(fn ($v) => $value, $options['fields']);

            $this->filters += $options['fields'];

            $this->query->where(function ($query) use ($fields, $options) {
                $this->filter($fields, $options['type'], $query);
            });
        }

        return $this;
    }

    public function sort(array $params): static
    {
        $params = $params ?: $this->defaultSort;
        $params = Arr::flatten($params);

        foreach ($params as $param) {
            if (str_starts_with($param, '-')) {
                $sort_direction = 'DESC';
                $param = substr($param, 1);
            } else {
                $sort_direction = 'ASC';
            }

            $type = $this->sortings[$param] ?? null;

            if (!$type) continue;

            switch ($type) {
                case self::SORT_TYPE_SIMPLE:
                    $this->query->orderBy($param, $sort_direction);
                    break;
                case self::SORT_TYPE_LOCALIZED:
                    $locale = app()->getLocale();
                    $this->query->orderBy("$param->$locale", $sort_direction);
                    break;
            }
        }

        return $this;
    }

    public function show(array $params): static
    {
        $params = Arr::flatten($params);

        $model = $this->query->getModel();
        $hasSoftDelete = in_array(SoftDeletes::class, class_uses_recursive($model));

        foreach ($params as $param) {
            switch ($param) {
                case 'with-deleted':
                    if ($hasSoftDelete) $this->query->withTrashed();
                    break;
                case 'only-deleted':
                    if ($hasSoftDelete) $this->query->onlyTrashed();
                    break;
            }
        }

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
