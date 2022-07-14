<?php

namespace Modules\Section\Enums;

use Modules\Section\Resources as Resources;
use Http\Admin\Section\Requests as Requests;

class SectionEnums
{
    public static function config(?string $name = null): array
    {
        $result = [
            'layout' => [
                'label' => __('Layout'),
                'resource' => Resources\LayoutResource::class,
                'admin_request' => Requests\LayoutRequest::class,
            ],
            'home' => [
                'label' => __('Home'),
                'resource' => Resources\HomeResource::class,
                'admin_request' => Requests\HomeRequest::class,
            ],
            'contact' => [
                'label' => __('Contact'),
                'resource' => Resources\ContactResource::class,
                'admin_request' => Requests\ContactRequest::class,
            ],
            'boxes' => [
                'label' => __('Boxes'),
                'resource' => Resources\EmptyResource::class,
                'admin_request' => Requests\EmptyRequest::class,
            ],
        ];

        return $name ? $result[$name] : $result;
    }
}
