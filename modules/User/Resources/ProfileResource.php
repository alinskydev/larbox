<?php

namespace Modules\User\Resources;

use App\Resources\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
