<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Illuminate\Support\Arr;

class Model extends BaseModel
{
    public const RELATION_TYPE_ONE_ONE = 'relationTypeOneOne';
    public const RELATION_TYPE_ONE_MANY = 'relationTypeOneMany';
    public const RELATION_TYPE_MANY_MANY = 'relationTypeManyMany';

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
            'seo_meta_morph',
            'deleted_at',
        ];

        $this->makeHidden($commonHiddenFields);

        //    Common appended fields

        if (in_array(SoftDeletes::class, class_uses_recursive($this))) {
            $this->append(['is_deleted']);
        }

        if (in_array(SeoMetaModelTrait::class, class_uses_recursive($this))) {
            $this->with[] = 'seo_meta_morph';
            $this->append(['seo_meta']);
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

            // Saving relations

            foreach ($model->fillableRelations as $relationType => $relations) {
                foreach ($relations as $relation => $value) {
                    switch ($relationType) {
                        case static::RELATION_TYPE_ONE_ONE:
                            $relatedModel = $model->$relation()->firstOrNew();
                            $relatedModel->fill($value)->save();
                            break;

                        case static::RELATION_TYPE_ONE_MANY:
                            $value = array_values((array)$value);
                            $ids = Arr::pluck($value, 'id');
                            $ids = array_filter($ids);

                            //  Trying to delete old records

                            if ($records = $model->$relation()->whereNotIn('id', $ids)->get()) {
                                foreach ($records as $record) {
                                    $record->delete();
                                }
                            }

                            //  Trying to save new records

                            foreach ($value as $k => $v) {
                                $id = $v['id'] ?? null;
                                $v['sort_index'] = $k;

                                $model->$relation()->updateOrCreate(['id' => $id], $v);
                            }

                            break;

                        case static::RELATION_TYPE_MANY_MANY:
                            $model->$relation()->sync($value);
                            break;
                    }
                }
            }
        });
    }
}
