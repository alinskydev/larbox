<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Search
{
    public const FILTER_TYPE_EQUAL = 'filterTypeEqual';
    public const FILTER_TYPE_LIKE = 'filterTypeLike';
    public const FILTER_TYPE_IN = 'filterTypeIn';
    public const FILTER_TYPE_BETWEEN = 'filterTypeBetween';
    public const FILTER_TYPE_DATE = 'filterTypeDate';
    public const FILTER_TYPE_DATETIME = 'filterTypeDatetime';
    public const FILTER_TYPE_LOCALIZED = 'filterTypeLocalized';
    public const FILTER_TYPE_JSON_CONTAINS_AND = 'filterTypeJsonContainsAnd';
    public const FILTER_TYPE_JSON_CONTAINS_OR = 'filterTypeJsonContainsOr';

    public const COMBINED_TYPE_AND = 'where';
    public const COMBINED_TYPE_OR = 'orWhere';

    public const SORT_TYPE_SIMPLE = 'sortTypeSimple';
    public const SORT_TYPE_LOCALIZED = 'sortTypeLocalized';

    public Builder $queryBuilder;
    public array $relations = [];
    public array $filters = [];
    public array $combinedFilters = [];
    public array $sortings = [];

    public array $defaultSort = ['-id'];
    public int $pageSize = 50;

    public function setQueryBuilder(Builder $queryBuilder): self
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }

    public function join(array $params): self
    {
        $params = Arr::flatten($params);
        $params = array_intersect($params, $this->relations);

        $this->queryBuilder->with($params);

        return $this;
    }

    public function filter(array $params, string $combinedType, ?Builder $query = null): self
    {
        $query = $query ?? $this->queryBuilder;

        foreach ($params as $param => $value) {
            $type = $this->filters[$param] ?? null;

            if (!$type) continue;

            $param = explode('.', $param);

            if (count($param) == 1) {
                $this->applyFilters(
                    query: $query,
                    param: $param[0],
                    type: $type,
                    value: $value,
                    combinedType: $combinedType,
                );
            } else {
                $lastParam = array_pop($param);

                $query->{$combinedType . 'Has'}(
                    implode('.', $param),
                    function ($subQuery) use ($lastParam, $type, $value, $combinedType) {
                        $subQuery->select('id');
                        $this->applyFilters(
                            query: $subQuery,
                            param: $lastParam,
                            type: $type,
                            value: $value,
                            combinedType: self::COMBINED_TYPE_AND,
                        );
                    }
                );
            }
        }

        return $this;
    }

    public function combinedFilter(array $params): self
    {
        foreach ($params as $param => $value) {
            $options = $this->combinedFilters[$param] ?? null;

            if (!$options) continue;

            $fields = array_map(fn ($v) => $value, $options['fields']);

            $this->filters += $options['fields'];

            $this->queryBuilder->where(function ($query) use ($fields, $options) {
                $this->filter($fields, $options['type'], $query);
            });
        }

        return $this;
    }

    private function applyFilters(Builder &$query, string $param, string $type, mixed $value, string $combinedType)
    {
        if (in_array($type, [
            self::FILTER_TYPE_IN,
            self::FILTER_TYPE_BETWEEN,
            self::FILTER_TYPE_JSON_CONTAINS_AND,
            self::FILTER_TYPE_JSON_CONTAINS_OR,
        ])) {
            $value = (array)$value;
        } else {
            $value = is_array($value) ? implode('', $value) : $value;
            $value = mb_strtolower((string)$value);
        }

        switch ($type) {
            case self::FILTER_TYPE_EQUAL:
                $query->{$combinedType}(DB::raw("LOWER($param)"), $value);
                break;
            case self::FILTER_TYPE_LIKE:
                $query->{$combinedType}(DB::raw("LOWER($param)"), 'LIKE', "%$value%");
                break;
            case self::FILTER_TYPE_IN:
                $query->{$combinedType . 'In'}($param, $value);
                break;
            case self::FILTER_TYPE_BETWEEN:
                if (isset($value[0])) $query->{$combinedType}(DB::raw("CAST($param as UNSIGNED INTEGER)"), '>=', (int)$value[0]);
                if (isset($value[1])) $query->{$combinedType}(DB::raw("CAST($param as UNSIGNED INTEGER)"), '<=', (int)$value[1]);
                break;
            case self::FILTER_TYPE_DATE:
                $query->{$combinedType}($param, '>=', date('Y-m-d 00:00:00', strtotime($value)));
                $query->{$combinedType}($param, '<=', date('Y-m-d 23:59:59', strtotime($value)));
                break;
            case self::FILTER_TYPE_DATETIME:
                $query->{$combinedType}($param, date('Y-m-d H:i:s', strtotime($value)));
                break;
            case self::FILTER_TYPE_LOCALIZED:
                $locale = app()->getLocale();
                $query->{$combinedType}(DB::raw("LOWER(JSON_UNQUOTE($param->'$.$locale'))"), 'LIKE', "%$value%");
                break;
            case self::FILTER_TYPE_JSON_CONTAINS_AND:
                $query->{$combinedType}(function ($q) use ($param, $value) {
                    foreach ($value as $v) $q->whereJsonContains($param, $v);
                });
                break;
            case self::FILTER_TYPE_JSON_CONTAINS_OR:
                $query->{$combinedType}(function ($q) use ($param, $value) {
                    foreach ($value as $v) $q->orWhereJsonContains($param, $v);
                });
                break;
        }
    }

    public function sort(array $params): self
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
                    $this->queryBuilder->orderBy($param, $sort_direction);
                    break;
                case self::SORT_TYPE_LOCALIZED:
                    $locale = app()->getLocale();
                    $this->queryBuilder->orderBy("$param->$locale", $sort_direction);
                    break;
            }
        }

        return $this;
    }

    public function show(array $params): self
    {
        $params = Arr::flatten($params);

        $model = $this->queryBuilder->getModel();
        $hasSoftDelete = in_array(SoftDeletes::class, class_uses_recursive($model));

        foreach ($params as $param) {
            switch ($param) {
                case 'with-deleted':
                    if ($hasSoftDelete) $this->queryBuilder->withTrashed();
                    break;
                case 'only-deleted':
                    if ($hasSoftDelete) $this->queryBuilder->onlyTrashed();
                    break;
            }
        }

        return $this;
    }

    public function setPageSize(int $pageSize): self
    {
        if ($pageSize > 0 && $pageSize <= $this->pageSize) {
            $this->pageSize = $pageSize;
        }

        return $this;
    }
}
