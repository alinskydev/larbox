<?php

namespace Modules\Section\Resources;

use App\Resources\JsonResource;
use App\Helpers\ImageHelper;

class HomeResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($this->name) {
            case 'welcome_image':
                return $this->value ? ImageHelper::populateSizes($this->value, [500]) : null;
            case 'images_list':
                return array_map(fn ($value) => ImageHelper::populateSizes($value, [500]), $this->value);
            case 'slider':
                return array_map(function ($value) {
                    $value['image'] = $value['image'] ? ImageHelper::populateSizes($value['image'], [500]) : null;
                    return $value;
                }, $this->value);
            case 'portfolio':
                return array_map(function ($value) {
                    $value['images_list'] = array_map(fn ($v) => ImageHelper::populateSizes($v, [500]), $value['images_list']);
                    return $value;
                }, $this->value);
            default:
                return $this->value;
        }
    }
}
