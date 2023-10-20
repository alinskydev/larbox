<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Helpers\RoleHelper;

class RoleResource extends JsonResource
{
    public function toArray($request): array
    {
        $result = parent::toArray($request);
        $result['routes'] = RoleHelper::routesList(true, $this->resource);

        return $result;
    }
}
