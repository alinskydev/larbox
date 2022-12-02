<?php

namespace Modules\Box\Resources;

use App\Hierarchy\HierarchyResource;

class CategoryResource extends HierarchyResource
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
                return $this->assignFullFieldToParents($this->parents, 'slug', '/');
            }) ?: [],
        ]);
    }
}
