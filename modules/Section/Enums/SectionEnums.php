<?php

namespace Modules\Section\Enums;

use Modules\Section\Base\JsonResource;
use Modules\Section\Base\EmptyFormRequest;

use Modules\Section\Resources as Resources;
use Http\Admin\Section\Requests as Requests;

class SectionEnums
{
    public static function config(?string $name = null): array
    {
        $result = [
            'boxes' => [
                'resource' => JsonResource::class,
                'request' => EmptyFormRequest::class,
            ],
            'contact' => [
                'resource' => JsonResource::class,
                'request' => Requests\ContactRequest::class,
            ],
            'home' => [
                'resource' => Resources\HomeResource::class,
                'request' => Requests\HomeRequest::class,
            ],
            'layout' => [
                'resource' => JsonResource::class,
                'request' => Requests\LayoutRequest::class,
            ],
        ];

        return $name ? $result[$name] : $result;
    }
}
