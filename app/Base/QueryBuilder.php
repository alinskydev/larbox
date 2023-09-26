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
 * 
 * @method $this limit($params)
 * @method $this offset($params)
 * 
 * @method $this withoutTrashed()
 * @method $this withTrashed()
 * @method $this onlyTrashed()
 * 
 * @method $this joinRelationship($params)
 * @method $this leftJoinRelationship($params)
 * @method $this rightJoinRelationship($params)
 */
class QueryBuilder extends Builder
{
    public function filterByUser($field): static
    {
        return $this->where($field, request()->user()->id);
    }
}
