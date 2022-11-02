<?php

namespace App\Hierarchy;

class HierarchyHelper
{
    public static function tree(HierarchyModel $model): array
    {
        $children = $model->children->toArray();
        $children = array_reverse($children);

        foreach ($children as &$child) {
            $child['children'] = array_filter($children, function ($value) use ($child) {
                return $value['lft'] > $child['lft'] && $value['rgt'] < $child['rgt'] && $value['depth'] == $child['depth'] + 1;
            });

            $child['children'] = array_reverse($child['children']);
        }

        $children = array_filter($children, fn ($value) => $value['depth'] == $model->depth + 1);
        $children = array_reverse($children);

        return $children;
    }

    public static function appendFullFieldToTree(array &$items, string $field, string $separator, array $prefix = []): array
    {
        $fullField = "full_$field";

        foreach ($items as &$item) {
            $fieldValue = $item[$field];
            $item[$fullField] = implode($separator, array_merge($prefix, [$fieldValue]));

            if ($item['children']) {
                self::appendFullFieldToTree($item['children'], $field, $separator, array_merge($prefix, [$fieldValue]));
            }
        }

        return $items;
    }
}
