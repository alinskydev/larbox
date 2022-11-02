<?php

namespace App\Hierarchy\Relations\Siblings;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

class HierarchyAllSiblingsRelation extends HasMany
{
    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        if (static::$constraints) {
            $query = $this->getRelationQuery();

            $parent = $this->getParent();

            $query->where('depth', '=', $parent->depth)
                ->where('id', '!=', $parent->id);

            $parentNode = $parent->parent;

            if ($parentNode) {
                $query->where('lft', '>', $parentNode->lft)
                    ->where('rgt', '<', $parentNode->rgt);
            }
        }
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array  $models
     * @return void
     */
    public function addEagerConstraints(array $models)
    {
        throw new \Exception('Not available');
    }

    /**
     * Match the eagerly loaded results to their many parents.
     *
     * @param  array  $models
     * @param  \Illuminate\Database\Eloquent\Collection  $results
     * @param  string  $relation
     * @param  string  $type
     * @return array
     */
    protected function matchOneOrMany(array $models, Collection $results, $relation, $type)
    {
        throw new \Exception('Not available');
    }

    /**
     * Add the constraints for a relationship query on the same table.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Builder  $parentQuery
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRelationExistenceQueryForSelfRelation(Builder $query, Builder $parentQuery, $columns = ['*'])
    {
        throw new \Exception('Not available');
    }
}
