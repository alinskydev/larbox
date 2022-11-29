<?php

namespace Modules\Feedback\Enums;

class FeedbackEnums
{
    public static function statuses(): array
    {
        return [
            'unprocessed' => __('Необработанный'),
            'in_process' => __('В процессе'),
            'closed' => __('Закрыт'),
        ];
    }
}
