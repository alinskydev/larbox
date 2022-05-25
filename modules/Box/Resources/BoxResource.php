<?php

namespace Modules\Box\Resources;

use App\Resources\JsonResource;

class BoxResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'brand' => JsonResource::make($this->whenLoaded('brand')),
            'tags' => JsonResource::collection($this->whenLoaded('tags')),
        ]);
    }
}
