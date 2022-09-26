<?php

namespace Modules\Section\Resources;

use Modules\Section\Base\JsonResource;

class HomeResource extends JsonResource
{
    protected array $imageGroups = [
        [
            'fields' => [
                'second_image' => null,
                'relations_1' => [
                    'image',
                    'images_list',
                ],
            ],
        ],
        [
            'fields' => [
                'second_images_list' => null,
                'second_image_desktop' => null,
                'second_image_tablet' => null,
                'second_image_mobile' => null,
                'relations_2' => [
                    'image_desktop',
                    'image_tablet',
                    'image_mobile',
                ],
            ],
        ],
    ];
}
