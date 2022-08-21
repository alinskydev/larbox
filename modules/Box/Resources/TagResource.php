<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
