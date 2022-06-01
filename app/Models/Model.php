<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\ActiveService;

class Model extends BaseModel
{
    const RELATION_TYPE_ONE_ONE = 'relationTypeOneOne';
    const RELATION_TYPE_ONE_MANY = 'relationTypeOneMany';
    const RELATION_TYPE_MANY_MANY = 'relationTypeManyMany';

    public array $fillableRelations = [];

    public function __construct(array $attributes = [])
    {
        //    Common guarded fields

        $commonGuardedFields = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $this->mergeGuarded($commonGuardedFields);

        //    Common hidden fields

        $commonHiddenFields = [
            'deleted_at',
        ];

        $this->makeHidden($commonHiddenFields);

        //    Common appended fields

        if (in_array(SoftDeletes::class, class_uses_recursive($this))) {
            $this->append(['is_deleted']);
        }

        return parent::__construct($attributes);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        $format = $this->dateFormat ?? LARBOX_FORMAT_DATETIME;
        return $date->format($format);
    }

    public function getIsDeletedAttribute()
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this))) {
            return (bool)$this->deleted_at;
        } else {
            return false;
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function (self $model) {
            (new ActiveService($model))->saveRelations();
        });
    }
}
