<?php

namespace App\NestedSet;

use Illuminate\Http\Resources\Json\JsonResource;

class NestedSetResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'children' => $this->when(false, false),
        ]);
    }

    protected function fullField(string $field, string $separator): string
    {
        $result = [
            ...$this->parents->pluck($field)->toArray(),
            $this->{$field},
        ];

        return implode($separator, $result);
    }

    protected function appendFullFieldToParents(string $field, string $separator): void
    {
        $fullField = "full_$field";
        $fields = [];

        foreach ($this->parents as &$parent) {
            $fields[] = $parent->{$field};
            $parent->{$fullField} = implode($separator, $fields);
        }
    }
}
