<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Resources\UserResource;

class BrandResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'creator' => UserResource::make($this->whenLoaded('creator')),
        ]);
    }
}
