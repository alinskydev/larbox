<?php

namespace App\Hierarchy;

use App\Base\Model as BaseModel;
use App\Hierarchy\Helper as HierarchyHelper;
use Illuminate\Support\Arr;

class Model extends BaseModel
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

    public function ancestors()
    {
        return $this->belongsTo(static::class, 'parent_id')->with('ancestors');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('position')->withTrashed()->with('children');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('depth', '>', 0);
        });

        static::creating(function (self $model) {
            $lastPosition = static::query()->where('parent_id', 1)->max('position');

            $model->parent_id ??= 1;
            $model->depth = 1;
            $model->position = $lastPosition === null ? 0 : $lastPosition + 1;
        });

        static::deleted(function (self $model) {
            $children = HierarchyHelper::childrenAsList($model);
            $childrenIds = Arr::pluck($children, 'id');

            static::query()->whereIn('id', $childrenIds)->delete();
        });

        static::restored(function (self $model) {
            $children = HierarchyHelper::childrenAsList($model);
            $childrenIds = Arr::pluck($children, 'id');

            static::query()->whereIn('id', $childrenIds)->restore();
        });
    }
}
