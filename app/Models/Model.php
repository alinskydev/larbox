<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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

        $guarded = array_merge($commonGuardedFields, $this->getGuarded());
        $guarded = array_unique($guarded);

        $this->guard($guarded);

        //    Common hidden fields

        $commonHiddenFields = [
            'deleted_at',
        ];

        $hidden = array_merge($commonHiddenFields, $this->getHidden());
        $hidden = array_unique($hidden);

        $this->setHidden($hidden);

        return parent::__construct($attributes);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        $format = $this->dateFormat ?? config('larbox.date_format.datetime');
        return $date->format($format);
    }

    protected static function boot()
    {
        parent::boot();

        // Saving relations

        static::saved(function ($model) {
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
