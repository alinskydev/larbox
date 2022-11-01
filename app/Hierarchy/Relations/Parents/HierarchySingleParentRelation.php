<?php

namespace App\Hierarchy\Relations\Parents;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

class HierarchySingleParentRelation extends HasOne
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

            $query->where('lft', '<', $parent->lft)
                ->where('rgt', '>', $parent->rgt)
                ->where('depth', $parent->depth - 1)
                ->withTrashed();
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
                        $q->where('lft', '<', $model->lft)
                            ->where('rgt', '>', $model->rgt)
                            ->where('depth', $model->depth - 1);
                    });
                }
            })
            ->withTrashed();
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
                // $relationValue = $results->where('lft', '<', $model->lft)->where('rgt', '>', $model->rgt);
                $relationValue = $results->where('lft', '<', $model->lft)->where('rgt', '>', $model->rgt)->first();
                $model->setRelation($relation, $relationValue);
            }
        }

        return $models;
    }
}
