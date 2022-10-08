<?php

namespace Modules\Section\Resources;

use Modules\Section\Base\JsonResource;

class HomeResource extends JsonResource
{
    protected array $imageGroups = [
        [
            'fields' => [
                'second_images_list',
                'second_image_desktop',
                'second_image_tablet',
                'second_image_mobile',
            ],
        ],
        [
            'relation' => 'relations_1',
            'fields' => [
                'image',
            ],
        ],
        [
            'relation' => 'relations_2',
            'fields' => [
                'images_list',
            ],
        ],
    ];
}
