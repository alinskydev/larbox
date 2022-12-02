<?php

namespace Modules\System\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    public function toArray($request): mixed
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
