<?php

namespace Modules\User\Enums;

class UserEnums
{
    public static function roles(): array
    {
        return [
            'admin' => [
                'label' => __('enums.user.role.admin'),
            ],
            'registered' => [
                'label' => __('enums.user.role.registered'),
            ],
        ];
    }
}
