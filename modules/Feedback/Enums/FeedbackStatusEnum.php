<?php

namespace Modules\Feedback\Enums;

use App\Base\EnumTrait;

enum FeedbackStatusEnum: string
{
    use EnumTrait;

    case UNPROCESSED = 'unprocessed';
    case IN_PROGRESS = 'in_process';
    case CLOSED = 'closed';

    public static function labels(): array
    {
        return [
            self::UNPROCESSED->value => __('Необработанный'),
            self::IN_PROGRESS->value => __('В процессе'),
            self::CLOSED->value => __('Закрыт'),
        ];
    }
}
