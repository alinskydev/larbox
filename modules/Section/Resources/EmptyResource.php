<?php

namespace Modules\Section\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmptyResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->value;
    }
}
