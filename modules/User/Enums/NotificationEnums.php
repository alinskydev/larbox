<?php

namespace Modules\User\Enums;

class NotificationEnums
{
    public static function types(): array
    {
        return [
            'message' => __('notifications.message.label'),
            'announcement' => __('notifications.announcement.label'),
        ];
    }
}
