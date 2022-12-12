<?php

namespace Modules\Box\Resources;

use App\NestedSet\NestedSetResource;

class CategoryResource extends NestedSetResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'full_slug' => $this->whenLoaded('parents', function () {
                return $this->fullField('slug', '/');
            }) ?: $this->slug,
            'full_text' => $this->whenLoaded('parents', function () {
                return $this->fullField('text', ' => ');
            }) ?: $this->text,
            'boxes_count' => $this->whenLoaded('children', function () {
                return $this->boxes_count + $this->children->sum('boxes_count');
            }),

            'parents' => $this->whenLoaded('parents', function () {
                $this->appendFullFieldToParents('slug', '/');
                return $this->parents->values();
            }),
        ]);
    }
}
