<?php

namespace Modules\Feedback\Search;

use App\Base\Search;

class CallbackSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'status' => self::FILTER_CLASS_EQUAL_RAW,
        
        'common' => [
            'condition' => self::FILTER_CONDITION_OR_WHERE,
            'filters' => [
                'full_name' => self::FILTER_CLASS_LIKE,
                'phone' => self::FILTER_CLASS_LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
    ];
}
