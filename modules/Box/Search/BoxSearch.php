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
        'id' => self::FILTER_TYPE_IN,
        'brand_id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LOCALIZED,
        'price' => self::FILTER_TYPE_BETWEEN,
        'date' => self::FILTER_TYPE_DATE,
        'datetime' => self::FILTER_TYPE_DATE,

        'tags.id' => self::FILTER_TYPE_IN,
    ];

    public array $combinedFilters = [
        'categories.id' => [
            'type' => self::COMBINED_TYPE_OR,
            'fields' => [
                'categories.id' => self::FILTER_TYPE_IN,
                'categories.parents.id' => self::FILTER_TYPE_IN,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
        'date' => self::SORT_TYPE_SIMPLE,
        'datetime' => self::SORT_TYPE_SIMPLE,
    ];
}
