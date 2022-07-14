<?php

namespace Modules\Section\Resources;

use App\Resources\JsonResource;

class EmptyResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->value;
    }
}
