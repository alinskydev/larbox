<?php

namespace App\Models;

class HierarchicalModel extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->with[] = 'ancestors';

        $this->append(['state']);

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
            $model->children()->delete();
        });

        static::restored(function (self $model) {
            $model->children()->restore();
        });
    }
}
