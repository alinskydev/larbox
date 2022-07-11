<?php

namespace Modules\Block\Resources;

use App\Resources\JsonResource;

class BlockResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);

        switch ($this->name) {
            case 'favicon':
            case 'logo':
                return $this->value ? asset($this->value) : null;
            default:
                return $this->value;
        }
    }
}
