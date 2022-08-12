<?php

namespace Modules\Section\Enums;

use Modules\Section\Resources as Resources;
use Http\Admin\Section\Requests as Requests;

class SectionEnums
{
    public static function config(?string $name = null): array
    {
        $result = [
            'boxes' => [
                'resource' => Resources\EmptyResource::class,
                'admin_request' => Requests\EmptyRequest::class,
            ],
            'contact' => [
                'resource' => Resources\ContactResource::class,
                'admin_request' => Requests\ContactRequest::class,
            ],
            'home' => [
                'resource' => Resources\HomeResource::class,
                'admin_request' => Requests\HomeRequest::class,
            ],

            'layout' => [
                'resource' => Resources\LayoutResource::class,
                'admin_request' => Requests\LayoutRequest::class,
            ],
        ];

        return $name ? $result[$name] : $result;
    }
}
