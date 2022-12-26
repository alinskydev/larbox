<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Models\Notification;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        $data = [];

        switch ($this->type) {
            case Notification::TYPE_ANNOUNCEMENT:
            case Notification::TYPE_MESSAGE:
                $data['text'] = $this->params['text'];
                break;

            case Notification::TYPE_FEEDBACK_CALLBACK_CREATED:
                $data['text'] = __("notifications.$this->type.text", $this->params);
                break;
        }

        return array_replace_recursive(parent::toArray($request), $data);
    }
}
