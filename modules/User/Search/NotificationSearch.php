<?php

namespace Modules\User\Search;

use App\Base\Search;

class NotificationSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'type' => self::FILTER_CLASS_EQUAL_RAW,
        'is_seen' => self::FILTER_CLASS_EQUAL_RAW,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
    ];
}
