<?php

namespace Modules\Feedback\Enums;

class FeedbackEnums
{
    public static function statuses(): array
    {
        return [
            'unprocessed' => [
                'label' => __('Необработанный'),
            ],
            'in_process' => [
                'label' => __('В процессе'),
            ],
            'closed' => [
                'label' => __('Закрыт'),
            ],
        ];
    }
}
