<?php

namespace Modules\Box\Resources;

use App\Resources\JsonResource;
use Modules\User\Resources\UserResource;

class BrandResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'creator' => UserResource::make($this->whenLoaded('creator')),
        ]);
    }
}
