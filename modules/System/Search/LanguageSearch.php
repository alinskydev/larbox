<?php

namespace Modules\System\Search;

use App\Base\Search;

class LanguageSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_EQUAL_RAW,
        'is_active' => self::FILTER_TYPE_EQUAL_RAW,
        'is_main' => self::FILTER_TYPE_EQUAL_RAW,
    ];

    public array $combinedFilters = [
        'common' => [
            'type' => self::COMBINED_TYPE_OR,
            'fields' => [
                'name' => self::FILTER_TYPE_LIKE,
                'code' => self::FILTER_TYPE_EQUAL_STRING,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
        'code' => self::SORT_TYPE_SIMPLE,
    ];
}
