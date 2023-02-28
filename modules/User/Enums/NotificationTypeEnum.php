<?php

namespace Modules\User\Enums;

use App\Base\EnumTrait;

enum NotificationTypeEnum: string
{
    use EnumTrait;

    case ANNOUNCEMENT = 'announcement';
    case FEEDBACK_CALLBACK_CREATED = 'feedback_callback_created';
    case MESSAGE = 'message';

    public static function labels(): array
    {
        $types = self::values();
        $types = array_combine($types, $types);

        return array_map(fn ($type) => __("user_notifications.$type.label"), $types);
    }
}
