<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_replace_recursive(parent::toArray($request), [
            'text' => __("user_notifications.$this->type.text", $this->params),
        ]);
    }
}
