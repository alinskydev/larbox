<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;

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

        // Saving relations

        static::saved(function (self $model) {
            foreach ($model->fillableRelations as $relationType => $relations) {
                foreach ($relations as $relation => $value) {
                    switch ($relationType) {
                        case self::RELATION_TYPE_ONE_ONE:
                            if ($relatedModel = $model->$relation) {
                                $relatedModel->fill($value)->save();
                            } else {
                                $related = $model->$relation()->getRelated();
                                $primaryKey = $related->getKeyName();

                                $related->$primaryKey = $model->id;
                                $related->fill($value)->save();
                            }

                            break;

                        case self::RELATION_TYPE_ONE_MANY:
                            $value = array_values((array)$value);
                            $ids = Arr::pluck($value, 'id');
                            $ids = array_filter($ids);

                            //  Trying to delete old records

                            if ($records = $model->$relation()->whereNotIn('id', $ids)->get()) {
                                DB::beginTransaction();

                                foreach ($records as $record) {
                                    try {
                                        $record->delete();
                                    } catch (\Exception $e) {
                                        DB::rollBack();
                                        abort(403, $e->getMessage());
                                    }
                                }

                                DB::commit();
                            }

                            //  Saving new records

                            foreach ($value as $k => $v) {
                                $id = $v['id'] ?? null;
                                $v['sort_index'] = $k;

                                $model->$relation()->updateOrCreate(['id' => $id], $v);
                            }

                            break;

                        case self::RELATION_TYPE_MANY_MANY:
                            $model->$relation()->sync($value);
                            break;
                    }
                }
            }
        });
    }
}
