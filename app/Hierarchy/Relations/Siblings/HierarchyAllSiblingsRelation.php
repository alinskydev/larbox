<?php

namespace App\Hierarchy\Relations\Siblings;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class HierarchyAllSiblingsRelation extends HasMany
{
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $parent = $this->getParent();

            $query = $this->getRelationQuery()
                ->where('depth', '=', $parent->depth)
                ->where('id', '!=', $parent->id);

            $parentNode = $parent->parent;

            if ($parentNode) {
                $query->where('lft', '>', $parentNode->lft)
                    ->where('rgt', '<', $parentNode->rgt);
            }
        }
    }

    public function addEagerConstraints(array $models): void
    {
        throw new \Exception('Not available');
    }

    protected function matchOneOrMany(array $models, Collection $results, $relation, $type): array
    {
        throw new \Exception('Not available');
    }

    public function getRelationExistenceQueryForSelfRelation(Builder $query, Builder $parentQuery, $columns = ['*']): Builder
    {
        throw new \Exception('Not available');
    }
}
