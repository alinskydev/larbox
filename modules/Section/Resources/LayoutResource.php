<?php

namespace Modules\Section\Resources;

use App\Resources\JsonResource;
use App\Helpers\ImageHelper;

class LayoutResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->value;
    }
}
