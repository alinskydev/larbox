<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Search
{
    const FILTER_TYPE_EQUAL = 'filterTypeEqual';
    const FILTER_TYPE_LIKE = 'filterTypeLike';
    const FILTER_TYPE_IN = 'filterTypeIn';
    const FILTER_TYPE_LOCALIZED = 'filterTypeLocalized';

    const SORT_TYPE_SIMPLE = 'sortTypeSimple';
    const SORT_TYPE_LOCALIZED = 'sortTypeLocalized';

    public Builder $queryBuilder;
    protected array $relations = [];
    protected array $filterable = [];
    protected array $sortable = [];

    protected int $maxPageSize = 30;
    public int $pageSize = 30;

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

    public function filter(array $params): self
    {
        foreach ($params as $param => $value) {
            $type = $this->filterable[$param] ?? null;

            if (!$type) continue;

            $param = explode('.', $param);

            $value = is_array($value) ? Arr::flatten($value) : $value;

            if (count($param) == 1) {
                $this->applyFilters($this->queryBuilder, $param[0], $type, $value);
            } else {
                $lastParam = array_pop($param);

                $this->queryBuilder->whereHas(implode('.', $param), function ($query) use ($lastParam, $type, $value) {
                    $query->select('id');
                    $this->applyFilters($query, $lastParam, $type, $value);
                });
            }
        }

        return $this;
    }

    private function applyFilters(Builder &$query, string $param, string $type, mixed $value)
    {
        if ($type != self::FILTER_TYPE_IN) {
            $value = is_array($value) ? implode('', $value) : $value;
        }

        switch ($type) {
            case self::FILTER_TYPE_EQUAL:
                $query->where($param, '=', $value);
                break;
            case self::FILTER_TYPE_LIKE:
                $query->where($param, 'ILIKE', "%$value%");
                break;
            case self::FILTER_TYPE_IN:
                $query->whereIn($param, (array)$value);
                break;
            case self::FILTER_TYPE_LOCALIZED:
                $locale = app()->getLocale();
                $query->where("$param->$locale", 'ILIKE', "%$value%");
                break;
        }
    }

    public function sort(array $params): self
    {
        $params = Arr::flatten($params);

        foreach ($params as $param) {
            if (str_starts_with($param, '-')) {
                $sort_direction = 'DESC';
                $param = substr($param, 1);
            } else {
                $sort_direction = 'ASC';
            }

            $type = $this->sortable[$param] ?? null;

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
        $this->pageSize = ($pageSize > 0 && $pageSize <= $this->maxPageSize) ? $pageSize : $this->maxPageSize;
        return $this;
    }
}
