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
        return new HierarchySingleParentRelation($this->newQuery(), $this, 'tree', 'tree');
    }

    public function parents()
    {
        // Only for getting relations
        return new HierarchyAllParentsRelation($this->newQuery(), $this, 'tree', 'tree');
    }

    public function children()
    {
        // Only for getting relations
        return new HierarchyAllChildrenRelation($this->newQuery(), $this, 'tree', 'tree');
    }

    public function siblings()
    {
        // Only for getting relations
        return new HierarchyAllSiblingsRelation($this->newQuery(), $this, 'tree', 'tree');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('box_category.depth', '>', 0);
        });

        static::creating(function (self $model) {
            $maxRgt = static::query()->max('rgt');

            $model->lft = $maxRgt + 1;
            $model->rgt = $maxRgt + 2;
            $model->depth = 1;
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
