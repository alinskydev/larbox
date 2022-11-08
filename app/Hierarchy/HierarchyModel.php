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
        return parent::__construct($attributes);
    }

    public function getStateAttribute()
    {
        return [
            'disabled' => (bool)$this->deleted_at,
            'hidden' => (bool)$this->deleted_at,
            'opened' => true,
        ];
    }

    public function parent()
    {
        // Only for getting relations
        return (new HierarchySingleParentRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    public function parents()
    {
        // Only for getting relations
        return (new HierarchyAllParentsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    public function children()
    {
        // Only for getting relations
        return (new HierarchyAllChildrenRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    public function siblings()
    {
        // Only for getting relations
        return (new HierarchyAllSiblingsRelation(static::query(), $this, 'tree', 'tree'))->withTrashed();
    }

    protected static function boot()
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
