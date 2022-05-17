<?php

namespace Modules\Region\Resources;

use App\Resources\JsonResource;

class RegionCityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'name' => $this->name,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'region' => RegionResource::make($this->whenLoaded('region')),
        ];
    }
}
