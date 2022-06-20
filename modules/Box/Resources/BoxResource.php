<?php

namespace Modules\Box\Resources;

use App\Resources\JsonResource;

class BoxResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'variations' => VariationResource::collection($this->whenLoaded('variations')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ]);
    }
}
