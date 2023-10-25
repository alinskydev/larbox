<?php

namespace App\NestedSet;

use Kalnoy\Nestedset\AncestorsRelation;
use Kalnoy\Nestedset\NodeTrait;

trait NestedSetModelTrait
{
    use NodeTrait {
        ancestors as ancestorsWithRoot;
    }

    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }

    public function getStateAttribute(): array
    {
        return [
            'disabled' => (bool)$this->deleted_at,
            'hidden' => (bool)$this->deleted_at,
            'opened' => true,
        ];
    }

    public function ancestors(): AncestorsRelation
    {
        return $this->ancestorsWithRoot()->whereNotNull('parent_id');
    }

    protected static function bootNestedSetModelTrait(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('lft');
        });

        static::retrieved(function (self $model) {
            $model->append(['text', 'state']);
        });

        static::created(function (self $model) {
            $model->newQuery()->findOrFail(1)->appendNode($model);
        });

        static::restoring(function (self $model) {
            $parent = $model->ancestors()->onlyTrashed()->first();
            if ($parent) throw new \Exception(__('Восстановление записи без родителя невозможно'));
        });
    }
}
