<?php

namespace Modules\Section\Enums;

use App\Base\EnumTrait;
use Illuminate\Support\Arr;
use Modules\Section\Base\JsonResource;
use Modules\Section\Base\EmptyFormRequest;

use Modules\Section\Resources as Resources;
use Http\Admin\Section\Requests as Requests;

enum SectionEnum: string
{
    use EnumTrait;

    case BOXES = 'boxes';
    case CONTACT = 'contact';
    case HOME = 'home';
    case LAYOUT = 'layout';

    public static function classes(): array
    {
        return [
            self::BOXES->value => [
                'resource' => JsonResource::class,
                'request' => EmptyFormRequest::class,
            ],
            self::CONTACT->value => [
                'resource' => JsonResource::class,
                'request' => Requests\ContactRequest::class,
            ],
            self::HOME->value => [
                'resource' => Resources\HomeResource::class,
                'request' => Requests\HomeRequest::class,
            ],
            self::LAYOUT->value => [
                'resource' => JsonResource::class,
                'request' => Requests\LayoutRequest::class,
            ],
        ];
    }

    public static function classByPath(string $path): string
    {
        return Arr::get(self::classes(), $path);
    }
}
