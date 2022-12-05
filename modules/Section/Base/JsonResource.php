<?php

namespace Modules\Section\Base;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use App\Helpers\ImageHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class JsonResource extends BaseJsonResource
{
    protected array $imageGroups = [];

    public function toArray($request): mixed
    {
        $result = Arr::dot($this->resource);

        foreach ($this->imageGroups as $group) {
            $sizes = $group['sizes'] ?? [500];
            $fields = $group['fields'] ?? [];

            foreach ($result as $key => &$value) {
                if (Str::is($fields, $key)) {
                    $value = $value ? ImageHelper::populateSizes($value, $sizes) : null;
                }
            }
        }

        $result = Arr::undot($result);

        return $result;
    }
}
