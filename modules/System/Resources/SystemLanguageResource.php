<?php

namespace Modules\System\Resources;
 
use App\Resources\JsonResource;
use App\Helpers\ImageHelper;

class SystemLanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'image' => $this->image ? [
                'w_100' => ImageHelper::thumbnail($this->image, 'widen', [100]),
                'original' => asset($this->image),
            ] : null,
            'is_active' => $this->is_active,
            'is_main' => $this->is_main,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
        ];
    }
}
