<?php

namespace Modules\User\Enums;

class NotificationEnums
{
    public static function types(): array
    {
        return [
            'message' => [
                'label' => __('notifications.message.label'),
            ],
            'announcement' => [
                'label' => __('notifications.announcement.label'),
            ],
        ];
    }
}
