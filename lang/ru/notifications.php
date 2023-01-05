<?php

use Modules\User\Enums\NotificationTypeEnum;

return [
    NotificationTypeEnum::ANNOUNCEMENT->value => [
        'label' => 'Объявление',
        'text' => ':text',
    ],
    NotificationTypeEnum::FEEDBACK_CALLBACK_CREATED->value => [
        'label' => 'Новая заявка с сообщением',
        'text' => 'Новая заявка с сообщением №:id',
    ],
    NotificationTypeEnum::MESSAGE->value => [
        'label' => 'Сообщение',
        'text' => ':text',
    ],
];
