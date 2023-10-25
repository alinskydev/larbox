<?php

namespace App\NestedSet;

use Illuminate\Http\Resources\Json\JsonResource;

class NestedSetResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'descendants' => $this->when(false, false),
        ]);
    }

    protected function fullField(string $field, string $separator): string
    {
        $result = [
            ...$this->ancestors->pluck($field)->toArray(),
            $this->{$field},
        ];

        return implode($separator, $result);
    }

    protected function appendFullFieldToAncestors(string $field, string $separator): void
    {
        $fullField = "full_$field";
        $fields = [];

        foreach ($this->ancestors as &$ancestor) {
            $fields[] = $ancestor->{$field};
            $ancestor->{$fullField} = implode($separator, $fields);
        }
    }
}
