<?php

namespace Modules\User\Resources;
 
use App\Resources\JsonResource;
use Modules\Region\Resources\RegionResource;
use Modules\Region\Resources\RegionCityResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'role' => $this->role,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,
            'messages_count' => $this->when($this->messages_count !== null, $this->messages_count),

            'regions' => RegionResource::collection($this->whenLoaded('regions')),
            'cities' => RegionCityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
