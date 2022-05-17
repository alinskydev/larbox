<?php

namespace Modules\User\Resources;
 
use App\Resources\JsonResource;
use App\Helpers\ImageHelper;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $profile = $this->profile;
        
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,
            
            'profile' => [
                'full_name' => $profile->full_name,
                'phone' => $profile->phone,
                'image' => $profile->image ? [
                    'w_500' => ImageHelper::thumbnail($profile->image, 'widen', [500]),
                    'original' => asset($profile->image),
                ] : null,
            ],
        ];
    }
}
