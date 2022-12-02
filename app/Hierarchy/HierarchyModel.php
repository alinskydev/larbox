<?php

namespace App\Hierarchy;

use App\Base\Model;

use App\Hierarchy\Relations\Parents\HierarchySingleParentRelation;
use App\Hierarchy\Relations\Parents\HierarchyAllParentsRelation;

use App\Hierarchy\Relations\Children\HierarchyAllChildrenRelation;

use App\Hierarchy\Relations\Siblings\HierarchyAllSiblingsRelation;

class HierarchyModel extends Model
{
    protected $textField;

    public function __construct(array $attributes = [])
    {
        $this->append(['text', 'state']);
        parent::__construct($attributes);
    }

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
    public function parent(): HierarchySingleParentRelation
    {
        return (new HierarchySingleParentRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function parents(): HierarchyAllParentsRelation
    {
        return (new HierarchyAllParentsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function children(): HierarchyAllChildrenRelation
    {
        return (new HierarchyAllChildrenRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    /**
     * Only for getting relations
     */
    public function siblings(): HierarchyAllSiblingsRelation
    {
        return (new HierarchyAllSiblingsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            $root = self::query()->findOrFail(1);

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
