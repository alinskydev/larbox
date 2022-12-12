<?php

namespace App\Base\Model;

use App\Base\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

trait ModelRelationsTrait
{
    private array $filledRelations = [
        'oneToOne' => [],
        'oneToMany' => [],
        'manyToMany' => [],
    ];

    public function fillRelations(
        array $oneToOne = [],
        array $oneToMany = [],
        array $manyToMany = [],
    ) {
        $this->filledRelations = [
            'oneToOne' => array_replace($this->filledRelations['oneToOne'], $oneToOne),
            'oneToMany' => array_replace($this->filledRelations['oneToMany'], $oneToMany),
            'manyToMany' => array_replace($this->filledRelations['manyToMany'], $manyToMany),
        ];
    }

    public static function bootModelRelationsTrait()
    {
        static::saved(function (self $model) {
            foreach ($model->filledRelations as $type => $relations) {
                foreach ($relations as $name => $value) {
                    $functionName = 'saveRelations' . ucfirst($type);
                    self::$functionName($model, $name, $value);
                }
            }
        });
    }

    private static function saveRelationsOneToOne(Model $model, string $name, array $attributes)
    {
        $relatedModel = $model->$name()->firstOrNew();
        $relatedModel->fill($attributes)->save();
    }

    private static function saveRelationsOneToMany(Model $model, string $name, array $groups)
    {
        $groups = array_values((array)$groups);

        // Deleting old relations

        $ids = Arr::pluck($groups, 'id');
        $ids = array_filter($ids, fn ($f_v) => $f_v !== null);

        $relations = $model->$name()->whereNotIn('id', $ids)->get();

        $relations->each(function ($relation, $key) {
            $relation->delete();
        });

        // Saving new relations

        foreach ($groups as $key => $group) {
            $id = $group['id'] ?? null;
            $group['sort_index'] = $key;

            $model->$name()->updateOrCreate(['id' => $id], $group);
        }
    }

    private static function saveRelationsManyToMany(Model $model, string $name, array $ids)
    {
        $relation = $model->$name();

        $relatedKeyName = $relation->getRelatedKeyName(); // E.g.: box_category.id
        $foreignPivotKeyName = $relation->getForeignPivotKeyName(); // E.g.: box_category_ref.box_id
        $relationPivotKeyName = $relation->getRelatedPivotKeyName(); // E.g.: box_category_ref.category_id

        $pivotTable = $relation->getTable();

        $oldRelationIds = $model->$name->pluck($relatedKeyName)->toArray();

        // Deleting old relations

        DB::table($pivotTable)
            ->where($foreignPivotKeyName, $model->getKey())
            ->whereNotIn($relationPivotKeyName, $ids)
            ->delete();

        // Saving new relations

        $ids = array_diff($ids, $oldRelationIds);

        $ids = array_map(fn ($id) => [
            $foreignPivotKeyName => $model->getKey(),
            $relationPivotKeyName => $id,
        ], $ids);

        DB::table($pivotTable)->insert($ids);
    }
}
