<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
