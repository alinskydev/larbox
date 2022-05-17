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
            'agent' => [
                'label' => __('enums.user.role.agent'),
            ],
        ];
    }
}
