<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use Illuminate\Support\Arr;

class JsonResource extends BaseJsonResource
{
    public function toArray($request)
    {
        $attributes = $this->getAttributes();
        
        return array_merge(
            parent::toArray($request),
            [
                'is_deleted' => $this->when(Arr::has($attributes, 'deleted_at'), (bool)$this->deleted_at),
            ]
        );
    }
}
