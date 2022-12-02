<?php

namespace App\Base;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Model extends BaseModel
{
    public const RELATION_TYPE_ONE_ONE = 'relationTypeOneOne';
    public const RELATION_TYPE_ONE_MANY = 'relationTypeOneMany';
    public const RELATION_TYPE_MANY_MANY = 'relationTypeManyMany';

    public array $fillableRelations = [];

    protected string $routeKeyName;

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

    protected function serializeDate(DateTimeInterface $date): string
    {
        $format = $this->dateFormat ?? LARBOX_FORMAT_DATETIME;
        return $date->format($format);
    }

    public function getRouteKeyName(): string
    {
        return $this->routeKeyName ?? $this->getKeyName();
    }

    public function setRouteKeyName($name): static
    {
        $this->routeKeyName = $name;
        return $this;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function (self $model) {

            // Saving relations

            foreach ($model->fillableRelations as $relationType => $relations) {
                foreach ($relations as $relationName => $value) {
                    switch ($relationType) {
                        case static::RELATION_TYPE_ONE_ONE:
                            $relatedModel = $model->$relationName()->firstOrNew();
                            $relatedModel->fill($value)->save();
                            break;

                        case static::RELATION_TYPE_ONE_MANY:
                            $value = array_values((array)$value);
                            $ids = Arr::pluck($value, 'id');
                            $ids = array_filter($ids, fn ($f_v) => $f_v !== null);

                            // Trying to delete old records

                            if ($records = $model->$relationName()->whereNotIn('id', $ids)->get()) {
                                foreach ($records as $record) {
                                    $record->delete();
                                }
                            }

                            // Trying to save new records

                            foreach ($value as $k => $v) {
                                $id = $v['id'] ?? null;
                                $v['sort_index'] = $k;

                                $model->$relationName()->updateOrCreate(['id' => $id], $v);
                            }

                            break;

                        case static::RELATION_TYPE_MANY_MANY:

                            // Getting keys

                            $relation = $model->$relationName();
                            $relatedKeyName = $relation->getRelatedKeyName(); // E.g.: box_category.id
                            $foreignPivotKeyName = $relation->getForeignPivotKeyName(); // E.g.: box_category_ref.box_id
                            $relationPivotKeyName = $relation->getRelatedPivotKeyName(); // E.g.: box_category_ref.category_id

                            $pivotTable = $relation->getTable();

                            $oldRelationIds = $model->$relationName->pluck($relatedKeyName)->toArray();

                            // Deleting old records

                            DB::table($pivotTable)
                                ->where($foreignPivotKeyName, $model->getKey())
                                ->whereNotIn($relationPivotKeyName, $value)
                                ->delete();

                            // Inserting old records

                            $value = array_diff($value, $oldRelationIds);

                            $value = array_map(fn ($v) => [
                                $foreignPivotKeyName => $model->getKey(),
                                $relationPivotKeyName => $v,
                            ], $value);

                            DB::table($pivotTable)->insert($value);

                            break;
                    }
                }
            }
        });
    }
}
