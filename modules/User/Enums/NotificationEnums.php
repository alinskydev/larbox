<?php

namespace Modules\User\Enums;

use Modules\User\Models\Notification;

class NotificationEnums
{
    public static function types(): array
    {
        $types = [
            Notification::TYPE_ANNOUNCEMENT,
            Notification::TYPE_FEEDBACK_CALLBACK_CREATED,
            Notification::TYPE_MESSAGE,
        ];

        $types = array_combine($types, $types);

        return array_map(fn($type) => __("notifications.$type.label"), $types);
    }
}
