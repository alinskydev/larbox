<?php

namespace Modules\Feedback\Search;

use App\Base\Search;

class CallbackSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'status' => self::FILTER_TYPE_EQUAL,
    ];

    public array $combinedFilters = [
        'common' => [
            'type' => self::COMBINED_TYPE_OR,
            'fields' => [
                'full_name' => self::FILTER_TYPE_LIKE,
                'phone' => self::FILTER_TYPE_LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
    ];
}
