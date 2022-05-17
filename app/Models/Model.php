<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Model extends BaseModel
{
    const RELATION_TYPE_ONE_ONE = 'relationTypeOneOne';
    const RELATION_TYPE_ONE_MANY = 'relationTypeOneMany';
    const RELATION_TYPE_MANY_MANY = 'relationTypeManyMany';

    public array $fillableRelations = [];

    protected static function boot()
    {
        parent::boot();

        // Saving relations

        static::saved(function ($model) {
            foreach ($model->fillableRelations as $relationType => $relations) {
                foreach ($relations as $relation => $value) {
                    switch ($relationType) {
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
