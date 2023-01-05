<?php

namespace App\Base\Model;

use App\Base\Model;
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

    protected static function bootModelRelationsTrait()
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
        $model->$name()->detach();
        $model->$name()->attach($ids);
    }
}
