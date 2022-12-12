<?php

namespace App\NestedSet\Relations\Parents;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class NestedSetAllParentsRelation extends HasMany
{
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $parent = $this->getParent();

            $this->getRelationQuery()
                ->where('lft', '<', $parent->lft)
                ->where('rgt', '>', $parent->rgt)
                ->where('depth', '>', 0)
                ->orderBy('lft');
        }
    }

    public function addEagerConstraints(array $models): void
    {
        $this->getRelationQuery()
            ->where(function ($query) use ($models) {
                foreach ($models as $model) {
                    $query->orWhere(function ($q) use ($model) {
                        $q->where('lft', '<', $model->lft)
                            ->where('rgt', '>', $model->rgt);
                    });
                }
            })
            ->where('depth', '>', 0)
            ->orderBy('lft');
    }

    protected function matchOneOrMany(array $models, Collection $results, $relation, $type): array
    {
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            if (isset($dictionary[$key = $this->getDictionaryKey($model->getAttribute($this->localKey))])) {
                $relationValue = $results
                    ->where('lft', '<', $model->lft)
                    ->where('rgt', '>', $model->rgt);

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
                '<',
                $this->parent->qualifyColumn('lft')
            )
            ->whereColumn(
                "$hash.rgt",
                '>',
                $this->parent->qualifyColumn('rgt')
            )
            ->where("$hash.depth", '>', 0);
    }
}
