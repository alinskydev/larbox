<?php

namespace App\Hierarchy\Relations\Children;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class HierarchyAllChildrenRelation extends HasMany
{
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $query = $this->getRelationQuery();

            $parent = $this->getParent();

            $query->where('lft', '>', $parent->lft)
                ->where('rgt', '<', $parent->rgt);
        }
    }

    public function addEagerConstraints(array $models): void
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

    protected function matchOneOrMany(array $models, Collection $results, $relation, $type): array
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

    public function getRelationExistenceQueryForSelfRelation(Builder $query, Builder $parentQuery, $columns = ['*']): Builder
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
