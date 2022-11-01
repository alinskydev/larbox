<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'full_slug' => $this->whenLoaded('parents', function () {
                return $this->fullField('slug', '/');
            }) ?: $this->slug,
            'full_text' => $this->whenLoaded('parents', function () {
                return $this->fullField('text', ' => ');
            }) ?: $this->text,

            'parents' => $this->whenLoaded('parents', function () {
                return $this->collectParents();
            }) ?: [],
        ]);
    }

    private function fullField(string $field, string $separator)
    {
        $result = $this->parents->pluck($field);
        $result[] = $this->{$field};

        return $result->join($separator);
    }

    private function collectParents()
    {
        $slugs = [];
        $result = [];

        foreach ($this->parents as $parent) {
            $slugs[] = $parent->slug;
            $parent->full_slug = implode('/', $slugs);
            $result[] = $parent;
        }

        return $result;
    }
}
