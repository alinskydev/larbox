<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [];

        switch ($this->type) {
            case 'message':
            case 'announcement':
                $data['message'] = $this->params['message'];
                break;
        }

        return array_replace_recursive(parent::toArray($request), $data);
    }
}
