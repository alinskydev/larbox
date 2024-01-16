<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method $this addSelect($params)
 * @method $this groupBy($params)
 * @method $this orderBy($params)
 * @method $this select($params)
 * @method $this whereBetween($params)
 * @method $this whereIn($params)
 * @method $this whereNull($params)
 * @method $this whereNotNull($params)
 * 
 * @method $this limit($params)
 * @method $this offset($params)
 * 
 * @method $this join($params)
 * @method $this leftJoin($params)
 * @method $this rightJoin($params)
 * 
 * @method $this withoutTrashed()
 * @method $this withTrashed()
 * @method $this onlyTrashed()
 */
class QueryBuilder extends Builder
{
    public function cloneForSummary(): static
    {
        $query = clone $this;
        $query->getQuery()->orders = [];
        $query->getQuery()->limit = null;
        $query->getQuery()->offset = null;

        return $query;
    }

    public function filterByUser($field): static
    {
        return $this->where($field, request()->user()->id);
    }
}
