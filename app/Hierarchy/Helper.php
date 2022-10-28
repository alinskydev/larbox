<?php

namespace App\Hierarchy;

class Helper
{
    public static function parentsAsList(Model $model)
    {
        return $model->parent ? array_merge([$model->parent], self::parentsAsList($model->parent)) : [];
    }

    public static function childrenAsList(Model $model)
    {
        $result = [];

        foreach ($model->children as $model) {
            $result[] = $model;
            $result = array_merge($result, self::childrenAsList($model));
        }

        return $result;
    }
}
