<?php

namespace Modules\Feedback\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CallbackResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
