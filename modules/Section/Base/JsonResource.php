<?php

namespace Modules\Section\Base;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use App\Helpers\ImageHelper;
use Illuminate\Support\Arr;

class JsonResource extends BaseJsonResource
{
    protected array $imageGroups = [];

    public function toArray($request)
    {
        foreach ($this->imageGroups as $group) {
            $sizes = $group['sizes'] ?? [500];

            foreach ($group['fields'] as $field => $subFields) {
                if ($field != $this->name) continue;

                if ($subFields) {
                    return array_map(function ($value) use ($subFields, $sizes) {
                        foreach ($subFields as $s_f) {
                            if (is_array($value[$s_f])) {
                                $value[$s_f] = array_map(fn ($v) => ImageHelper::populateSizes($v, $sizes), $value[$s_f]);
                            } else {
                                $value[$s_f] = $value[$s_f] ? ImageHelper::populateSizes($value[$s_f], $sizes) : null;
                            }
                        }

                        return $value;
                    }, $this->value);
                } else {
                    if (is_array($this->value)) {
                        return array_map(fn ($value) => ImageHelper::populateSizes($value, $sizes), $this->value);
                    } else {
                        return $this->value ? ImageHelper::populateSizes($this->value, $sizes) : null;
                    }
                }
            }
        }

        return $this->value;
    }
}
