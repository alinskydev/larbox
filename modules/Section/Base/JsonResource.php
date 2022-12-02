<?php

namespace Modules\Section\Base;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use App\Helpers\ImageHelper;

class JsonResource extends BaseJsonResource
{
    protected array $imageGroups = [];

    public function toArray($request): mixed
    {
        foreach ($this->imageGroups as $group) {
            $relation = $group['relation'] ?? null;
            $sizes = $group['sizes'] ?? [500];

            if ($relation == $this->name) {
                return array_map(function ($value) use ($group, $sizes) {
                    foreach ($group['fields'] as $field) {
                        if (is_array($value[$field])) {
                            $value[$field] = array_map(fn ($v) => ImageHelper::populateSizes($v, $sizes), $value[$field]);
                        } else {
                            $value[$field] = $value[$field] ? ImageHelper::populateSizes($value[$field], $sizes) : null;
                        }
                    }

                    return $value;
                }, $this->value);
            }

            foreach ($group['fields'] as $field) {
                if ($field != $this->name) continue;

                if (is_array($this->value)) {
                    return array_map(fn ($value) => ImageHelper::populateSizes($value, $sizes), $this->value);
                } else {
                    return $this->value ? ImageHelper::populateSizes($this->value, $sizes) : null;
                }
            }
        }

        return $this->value;
    }
}
