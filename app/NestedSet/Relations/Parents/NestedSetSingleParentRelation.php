<?php

namespace App\NestedSet\Relations\Parents;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class NestedSetSingleParentRelation extends HasOne
{
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $parent = $this->getParent();

            $this->getRelationQuery()
                ->where('lft', '<', $parent->lft)
                ->where('rgt', '>', $parent->rgt)
                ->where('depth', $parent->depth - 1);
        }
    }

    public function addEagerConstraints(array $models): void
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
            });
    }

    protected function matchOneOrMany(array $models, Collection $results, $relation, $type): array
    {
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            if (isset($dictionary[$key = $this->getDictionaryKey($model->getAttribute($this->localKey))])) {
                $relationValue = $results
                    ->where('lft', '<', $model->lft)
                    ->where('rgt', '>', $model->rgt)
                    ->first();

                $model->setRelation($relation, $relationValue);
            }
        }

        return $models;
    }
}
