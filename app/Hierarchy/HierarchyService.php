<?php

namespace App\Hierarchy;

use App\Base\ActiveService;

class HierarchyService extends ActiveService
{
    public function tree(): array
    {
        $children = $this->model->children->toArray();
        $children = array_reverse($children);

        foreach ($children as &$child) {
            $child['children'] = array_filter($children, function ($value) use ($child) {
                return $value['lft'] > $child['lft'] && $value['rgt'] < $child['rgt'] && $value['depth'] == $child['depth'] + 1;
            });

            $child['children'] = array_reverse($child['children']);
        }

        $children = array_filter($children, fn ($value) => $value['depth'] == $this->model->depth + 1);
        $children = array_reverse($children);

        return $children;
    }
}
