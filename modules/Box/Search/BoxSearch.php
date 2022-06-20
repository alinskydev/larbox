<?php

namespace Modules\Box\Search;

use App\Search\Search;

class BoxSearch extends Search
{
    public array $relations = [
        'brand', 'variations', 'tags',
    ];

    public array $filterable = [
        'id' => self::FILTER_TYPE_IN,
        'brand_id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LOCALIZED,
        'slug' => self::FILTER_TYPE_EQUAL,
        'date' => self::FILTER_TYPE_DATE,
        'datetime' => self::FILTER_TYPE_DATETIME,
    ];

    public array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
        'date' => self::SORT_TYPE_SIMPLE,
        'datetime' => self::SORT_TYPE_SIMPLE,
    ];
}
