<?php

namespace Modules\Shop\Resources;

use App\Resources\JsonResource;
use Modules\User\Resources\UserResource;

class ShopContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'creator' => UserResource::make($this->whenLoaded('creator')),
        ];
    }
}
