<?php

namespace Modules\User\Resources;

use App\Resources\JsonResource;

class UserMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'text' => $this->text,
            'files_list' => array_map(fn ($value) => asset($value), $this->files_list),
            'is_sent_by_admin' => $this->is_sent_by_admin,
            'is_seen' => $this->is_seen,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),

            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
