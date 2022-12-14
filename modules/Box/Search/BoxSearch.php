<?php

namespace Modules\Box\Search;

use App\Base\Search;

class BoxSearch extends Search
{
    public array $relations = [
        'brand', 'variations', 'tags',
        'categories', 'categories.parents',
    ];

    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'brand_id' => self::FILTER_CLASS_EQUAL_RAW,
        'name' => self::FILTER_CLASS_LOCALIZED_LIKE,
        'price' => self::FILTER_CLASS_BETWEEN_NUMBER,
        'date' => self::FILTER_CLASS_BETWEEN_DATE,
        'datetime' => self::FILTER_CLASS_DATE,

        'tags.id' => self::FILTER_CLASS_IN,
        
        'categories.id' => [
            'condition' => self::FILTER_CONDITION_OR_WHERE,
            'filters' => [
                'categories.id' => self::FILTER_CLASS_EQUAL_RAW,
                'categories.parents.id' => self::FILTER_CLASS_EQUAL_RAW,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
        'name' => self::SORT_TYPE_LOCALIZED,
        'date' => self::SORT_TYPE_RAW,
        'datetime' => self::SORT_TYPE_RAW,
    ];
}
