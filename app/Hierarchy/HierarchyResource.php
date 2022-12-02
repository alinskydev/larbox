<?php

namespace App\Hierarchy;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;

class HierarchyResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'children' => $this->when(false, false),
        ]);
    }

    protected function fullField(string $field, string $separator): string
    {
        $result = $this->parents->pluck($field)->toArray();
        $result[] = $this->{$field};

        return implode($separator, $result);
    }

    protected function assignFullFieldToParents(Collection $parents, string $field, string $separator): Collection
    {
        $fullField = "full_$field";
        $slugs = [];

        foreach ($parents as &$parent) {
            $slugs[] = $parent->{$field};
            $parent->{$fullField} = implode($separator, $slugs);
        }

        return $parents;
    }
}
