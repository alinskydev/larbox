<?php

namespace Modules\User\Enums;

class NotificationEnums
{
    public static function types(): array
    {
        return [
            'message' => [
                'label' => __('Сообщение'),
            ],
            'announcement' => [
                'label' => __('Объявление'),
            ],
        ];
    }
}
