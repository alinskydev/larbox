<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'variations' => VariationResource::collection($this->whenLoaded('variations')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ]);
    }
}
