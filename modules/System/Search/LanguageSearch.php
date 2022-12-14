<?php

namespace Modules\System\Search;

use App\Base\Search;

class LanguageSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'is_active' => self::FILTER_CLASS_EQUAL_RAW,
        'is_main' => self::FILTER_CLASS_EQUAL_RAW,
        
        'common' => [
            'condition' => self::FILTER_CONDITION_OR_WHERE,
            'filters' => [
                'name' => self::FILTER_CLASS_LIKE,
                'code' => self::FILTER_CLASS_EQUAL_STRING,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
        'name' => self::SORT_TYPE_RAW,
        'code' => self::SORT_TYPE_RAW,
    ];
}
