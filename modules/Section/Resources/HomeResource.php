<?php

namespace Modules\Section\Resources;

use Modules\Section\Base\JsonResource;

class HomeResource extends JsonResource
{
    protected array $imageGroups = [
        [
            'fields' => [
                'second_images_list.*',
                'second_image_desktop',
                'second_image_tablet',
                'second_image_mobile',

                'relations_1.*.image',

                'relations_2.*.images_list.*',
            ],
        ],
    ];
}
