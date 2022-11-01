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
                ->where('rgt', '<', $parent->rgt)
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
                        $q->where('lft', '>', $model->lft)
                            ->where('rgt', '<', $model->rgt);
                    });
                }
            })
            ->orderBy('lft')
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
                $relationValue = $results->where('lft', '>', $model->lft)->where('rgt', '<', $model->rgt);
                $model->setRelation($relation, $relationValue);
            }
        }

        return $models;
    }
}
