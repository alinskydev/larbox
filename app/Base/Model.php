<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Base\Model\ModelSafelyTrait;
use App\Base\Model\ModelRelationsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static QueryBuilder query()
 */
class Model extends BaseModel
{
    use ModelSafelyTrait;
    use ModelRelationsTrait;

    public function __construct(array $attributes = [])
    {
        $this->mergeGuarded([
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);

        $this->makeHidden([
            'deleted_at',
            'sort_index',
            'pivot',
            'seo_meta_morph',
        ]);

        if (in_array(SoftDeletes::class, class_uses_recursive($this))) {
            $this->append(['is_deleted']);
        }

        parent::__construct($attributes);
    }

    public function getIsDeletedAttribute(): bool
    {
        return (bool)$this->deleted_at;
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        $format = $this->dateFormat ?? 'Y-m-d H:i:s';
        return $date->format($format);
    }

    public function newEloquentBuilder($query)
    {
        return new QueryBuilder($query);
    }
}
