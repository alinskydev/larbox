<?php

namespace Modules\User\Search;

use App\Search\Search;

class NotificationSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'type' => self::FILTER_TYPE_EQUAL,
        'is_seen' => self::FILTER_TYPE_EQUAL,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
    ];
}
