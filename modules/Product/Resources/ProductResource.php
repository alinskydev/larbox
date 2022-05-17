<?php

namespace Modules\Product\Resources;

use App\Resources\JsonResource;
use Modules\User\Resources\UserResource;
use App\Helpers\ImageHelper;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'model_number' => $this->model_number,
            'sku' => $this->sku,
            'date_eol' => $this->date_eol->format('d.m.Y'),
            'images_list' => array_map(fn ($value) => [
                'w_500' => ImageHelper::thumbnail($value, 'widen', [500]),
                'original' => asset($value),
            ], $this->images_list),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'creator' => UserResource::make($this->whenLoaded('creator')),
            'category' => ProductCategoryResource::make($this->whenLoaded('category')),
            'brand' => ProductBrandResource::make($this->whenLoaded('brand')),
            'variations' => ProductVariationResource::collection($this->whenLoaded('variations')),
        ];
    }
}
