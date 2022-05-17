<?php

namespace Modules\System\Resources;
 
use App\Resources\JsonResource;

class SystemSettingsResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($this->name) {
            case 'favicon':
            case 'logo':
                return $this->value ? asset($this->value) : null;
            default:
                return $this->value;
        }
    }
}
