<?php

namespace Modules\User\Resources;

use App\Resources\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'profile' => ProfileResource::make($this->whenLoaded('profile')),
        ]);
    }
}
