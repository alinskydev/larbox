<?php

namespace App\Services;

use App\Models\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ActiveService
{
    public function __construct(
        public Model $model
    ) {
    }

    public function saveRelations()
    {
        foreach ($this->model->fillableRelations as $relationType => $relations) {
            foreach ($relations as $relation => $value) {
                switch ($relationType) {
                    case $this->model::RELATION_TYPE_ONE_ONE:
                        if ($relatedModel = $this->model->$relation) {
                            $relatedModel->fill($value)->save();
                        } else {
                            $related = $this->model->$relation()->getRelated();
                            $primaryKey = $related->getKeyName();

                            $related->$primaryKey = $this->model->id;
                            $related->fill($value)->save();
                        }

                        break;

                    case $this->model::RELATION_TYPE_ONE_MANY:
                        $value = array_values((array)$value);
                        $ids = Arr::pluck($value, 'id');
                        $ids = array_filter($ids);

                        //  Trying to delete old records

                        if ($records = $this->model->$relation()->whereNotIn('id', $ids)->get()) {
                            DB::beginTransaction();

                            foreach ($records as $record) {
                                try {
                                    $record->delete();
                                } catch (\Throwable $e) {
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

                            $this->model->$relation()->updateOrCreate(['id' => $id], $v);
                        }

                        break;

                    case $this->model::RELATION_TYPE_MANY_MANY:
                        $this->model->$relation()->sync($value);
                        break;
                }
            }
        }
    }
}
