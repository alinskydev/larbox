<?php

namespace Modules\User\Enums;

class UserEnums
{
    public static function roles(): array
    {
        return [
            'admin' => [
                'label' => __('Администратор'),
            ],
            'registered' => [
                'label' => __('Зарегистрированный'),
            ],
        ];
    }
}
