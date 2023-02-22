<?php

namespace Modules\Feedback\Enums;

use App\Base\EnumTrait;

enum FeedbackStatusEnum: string
{
    use EnumTrait;

    case UNPROCESSED = 'unprocessed';
    case IN_PROGRESS = 'in_progress';
    case CLOSED = 'closed';

    public static function labels(): array
    {
        return [
            self::UNPROCESSED->value => __('Unprocessed'),
            self::IN_PROGRESS->value => __('In progress'),
            self::CLOSED->value => __('Closed'),
        ];
    }
}
