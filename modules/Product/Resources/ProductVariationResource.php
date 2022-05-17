<?php

namespace Modules\Product\Resources;

use App\Resources\JsonResource;
use App\Helpers\ImageHelper;

class ProductVariationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'images_list' => array_map(fn ($value) => [
                'w_500' => ImageHelper::thumbnail($value, 'widen', [500]),
                'original' => asset($value),
            ], $this->images_list),
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'options' => ProductSpecificationResource::collection($this->whenLoaded('options')),
        ];
    }
}
