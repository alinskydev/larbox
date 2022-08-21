<?php

namespace Modules\Section\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\ImageHelper;

class LayoutResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->value;
    }
}
