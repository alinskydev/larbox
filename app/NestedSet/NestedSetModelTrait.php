<?php

namespace App\NestedSet;

use App\NestedSet\Relations\Parents\NestedSetSingleParentRelation;
use App\NestedSet\Relations\Parents\NestedSetAllParentsRelation;
use App\NestedSet\Relations\Children\NestedSetAllChildrenRelation;
use App\NestedSet\Relations\Siblings\NestedSetAllSiblingsRelation;

trait NestedSetModelTrait
{
    public function getStateAttribute(): array
    {
        return [
            'disabled' => (bool)$this->deleted_at,
            'hidden' => (bool)$this->deleted_at,
            'opened' => true,
        ];
    }

    /**
     * Only for getting relations
     */
    public function parent(): NestedSetSingleParentRelation
    {
        return (new NestedSetSingleParentRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function parents(): NestedSetAllParentsRelation
    {
        return (new NestedSetAllParentsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function children(): NestedSetAllChildrenRelation
    {
        return (new NestedSetAllChildrenRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function siblings(): NestedSetAllSiblingsRelation
    {
        return (new NestedSetAllSiblingsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }


    protected static function bootNestedSetModelTrait()
    {
        static::retrieved(function (self $model) {
            $model->append(['text', 'state']);
        });

        static::creating(function (self $model) {
            $root = $model->newQuery()->findOrFail(1);

            $model->lft = $root->rgt;
            $model->rgt = $root->rgt + 1;
            $model->depth = 1;

            $root->rgt += 2;
            $root->saveQuietly();
        });

        static::deleted(function (self $model) {
            $model->children()->delete();
        });

        static::restoring(function (self $model) {
            $parent = $model->parents()->onlyTrashed()->first();
            if ($parent) throw new \Exception(__('Восстановление записи без родителя невозможно'));
        });

        static::restored(function (self $model) {
            $model->children()->restore();
        });
    }
}
