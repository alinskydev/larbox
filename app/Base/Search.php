<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Search
{
    public const FILTER_TYPE_BETWEEN_DATE = 'FILTER_TYPE_BETWEEN_DATE';
    public const FILTER_TYPE_BETWEEN_DATETIME = 'FILTER_TYPE_BETWEEN_DATETIME';
    public const FILTER_TYPE_BETWEEN_NUMBER = 'FILTER_TYPE_BETWEEN_NUMBER';
    public const FILTER_TYPE_DATE = 'FILTER_TYPE_DATE';
    public const FILTER_TYPE_DATETIME = 'FILTER_TYPE_DATETIME';
    public const FILTER_TYPE_EQUAL_RAW = 'FILTER_TYPE_EQUAL_RAW';
    public const FILTER_TYPE_EQUAL_STRING = 'FILTER_TYPE_EQUAL_STRING';
    public const FILTER_TYPE_IN = 'FILTER_TYPE_IN';
    public const FILTER_TYPE_JSON_CONTAINS_AND = 'FILTER_TYPE_JSON_CONTAINS_AND';
    public const FILTER_TYPE_JSON_CONTAINS_OR = 'FILTER_TYPE_JSON_CONTAINS_OR';
    public const FILTER_TYPE_LIKE = 'FILTER_TYPE_LIKE';
    public const FILTER_TYPE_LOCALIZED = 'FILTER_TYPE_LOCALIZED';

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

    public function setQueryBuilder(Builder $queryBuilder): static
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }

    public function with(array $params): static
    {
        $params = Arr::flatten($params);
        $params = array_intersect($params, $this->relations);

        $this->queryBuilder->with($params);

        return $this;
    }

    public function filter(array $params, string $combinedType, ?Builder $query = null): static
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

    public function combinedFilter(array $params): static
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

    private function applyFilters(
        Builder &$query,
        string $param,
        string $type,
        mixed $value,
        string $combinedType,
    ): void {
        if (in_array($type, [
            self::FILTER_TYPE_BETWEEN_DATE,
            self::FILTER_TYPE_BETWEEN_DATETIME,
            self::FILTER_TYPE_BETWEEN_NUMBER,
            self::FILTER_TYPE_IN,
            self::FILTER_TYPE_JSON_CONTAINS_AND,
            self::FILTER_TYPE_JSON_CONTAINS_OR,
        ])) {
            $value = (array)$value;
        } else {
            $value = is_array($value) ? implode('', $value) : $value;
            $value = mb_strtolower((string)$value);
        }

        switch ($type) {
            case self::FILTER_TYPE_BETWEEN_DATE:
                if (isset($value[0])) $query->{$combinedType}($param, '>=', date('Y-m-d 00:00:00', strtotime($value[0])));
                if (isset($value[1])) $query->{$combinedType}($param, '<=', date('Y-m-d 23:59:59', strtotime($value[1])));
                break;
            case self::FILTER_TYPE_BETWEEN_DATETIME:
                if (isset($value[0])) $query->{$combinedType}($param, '>=', date('Y-m-d H:i:s', strtotime($value[0])));
                if (isset($value[1])) $query->{$combinedType}($param, '<=', date('Y-m-d H:i:s', strtotime($value[1])));
                break;
            case self::FILTER_TYPE_BETWEEN_NUMBER:
                if (isset($value[0])) $query->{$combinedType}(DB::raw("$param::INTEGER"), '>=', (int)$value[0]);
                if (isset($value[1])) $query->{$combinedType}(DB::raw("$param::INTEGER"), '>=', (int)$value[1]);
                break;
            case self::FILTER_TYPE_DATE:
                $query->{$combinedType}($param, '>=', date('Y-m-d 00:00:00', strtotime($value)));
                $query->{$combinedType}($param, '<=', date('Y-m-d 23:59:59', strtotime($value)));
                break;
            case self::FILTER_TYPE_DATETIME:
                $query->{$combinedType}($param, date('Y-m-d H:i:s', strtotime($value)));
                break;
            case self::FILTER_TYPE_EQUAL_RAW:
                $query->{$combinedType}($param, $value);
                break;
            case self::FILTER_TYPE_EQUAL_STRING:
                $query->{$combinedType}(DB::raw("LOWER($param::VARCHAR)"), $value);
                break;
            case self::FILTER_TYPE_IN:
                $query->{$combinedType . 'In'}($param, $value);
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
            case self::FILTER_TYPE_LIKE:
                $query->{$combinedType}(DB::raw("LOWER($param::VARCHAR)"), 'LIKE', "%$value%");
                break;
            case self::FILTER_TYPE_LOCALIZED:
                $locale = app()->getLocale();
                $query->{$combinedType}(DB::raw("LOWER($param->>'$locale')"), 'LIKE', "%$value%");
                break;
        }
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

    public function show(array $params): static
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

    public function setPageSize(int $pageSize): static
    {
        if ($pageSize > 0 && $pageSize <= $this->pageSize) {
            $this->pageSize = $pageSize;
        }

        return $this;
    }
}
