<?php

namespace Modules\Box\Resources;

use App\NestedSet\NestedSetResource;

class CategoryResource extends NestedSetResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'full_slug' => $this->whenLoaded('ancestors', fn () => $this->fullField('slug', '/')) ?: $this->slug,
            'full_text' => $this->whenLoaded('ancestors', fn () => $this->fullField('text', ' => ')) ?: $this->text,
            'boxes_count' => $this->whenLoaded('descendants', function () {
                return $this->boxes_count + $this->descendants->sum('boxes_count');
            }),

            'ancestors' => $this->whenLoaded('ancestors', function () {
                $this->appendFullFieldToAncestors('slug', '/');
                return $this->ancestors->values();
            }),
        ]);
    }
}
