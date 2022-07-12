<?php

namespace Modules\Section\Enums;

use Modules\Section\Resources as Resources;
use Modules\Section\Requests as Requests;

class SectionEnums
{
    public static function config(?string $name = null): array
    {
        $result = [
            'layout' => [
                'label' => __('Layout'),
                'resource' => Resources\LayoutResource::class,
                'request' => Requests\LayoutRequest::class,
            ],
            'home' => [
                'label' => __('Home'),
                'resource' => Resources\HomeResource::class,
                'request' => Requests\HomeRequest::class,
            ],
            'contact' => [
                'label' => __('Contact'),
                'resource' => Resources\ContactResource::class,
                'request' => Requests\ContactRequest::class,
            ],
            'boxes' => [
                'label' => __('Boxes'),
                'resource' => Resources\EmptyResource::class,
                'request' => Requests\EmptyRequest::class,
            ],
        ];

        return $name ? $result[$name] : $result;
    }
}
