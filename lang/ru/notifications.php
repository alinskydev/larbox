<?php

use Modules\User\Models\Notification;

return [
    Notification::TYPE_ANNOUNCEMENT => [
        'label' => 'Объявление',
    ],
    Notification::TYPE_FEEDBACK_CALLBACK_CREATED => [
        'label' => 'Новая заявка с сообщением',
        'text' => 'Новая заявка с сообщением №:id',
    ],
    Notification::TYPE_MESSAGE => [
        'label' => 'Сообщение',
    ],
];
