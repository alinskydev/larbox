<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}