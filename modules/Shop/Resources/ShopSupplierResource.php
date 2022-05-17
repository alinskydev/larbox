<?php

namespace Modules\Shop\Resources;

use App\Resources\JsonResource;
use Modules\User\Resources\UserResource;
use Modules\Region\Resources\RegionCountryResource;

class ShopSupplierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'country_id' => $this->country_id,
            'short_name' => $this->short_name,
            'full_name' => $this->full_name,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'creator' => UserResource::make($this->whenLoaded('creator')),
            'country' => RegionCountryResource::make($this->whenLoaded('country')),
        ];
    }
}
