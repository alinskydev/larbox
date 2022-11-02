<?php

namespace App\Hierarchy\Relations\Children;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

class HierarchyAllChildrenRelation extends HasMany
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

            $query->where('lft', '>', $parent->lft)
                ->where('rgt', '<', $parent->rgt);
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
        $this->getRelationQuery()
            ->where(function ($query) use ($models) {
                foreach ($models as $model) {
                    $query->orWhere(function ($q) use ($model) {
                        $q->where('lft', '>', $model->lft)
                            ->where('rgt', '<', $model->rgt);
                    });
                }
            })
            ->orderBy('lft');
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
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            if (isset($dictionary[$key = $this->getDictionaryKey($model->getAttribute($this->localKey))])) {
                $relationValue = $results->where('lft', '>', $model->lft)->where('rgt', '<', $model->rgt);
                $model->setRelation($relation, $relationValue);
            }
        }

        return $models;
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
        $query->from($query->getModel()->getTable() . ' as ' . $hash = $this->getRelationCountHash());

        $query->getModel()->setTable($hash);

        return $query
            ->select($columns)
            ->whereColumn(
                "$hash.lft",
                '>',
                $this->parent->qualifyColumn('lft')
            )
            ->whereColumn(
                "$hash.rgt",
                '<',
                $this->parent->qualifyColumn('rgt')
            );
    }
}
