<?php

namespace Modules\Box\Search;

use App\Search\Search;

class BoxSearch extends Search
{
    public array $relations = [
        'brand', 'variations', 'tags',
    ];

    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'brand_id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LOCALIZED,
        'date' => self::FILTER_TYPE_DATE,
        'datetime' => self::FILTER_TYPE_DATETIME,

        'tags.id' => self::FILTER_TYPE_IN,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
        'date' => self::SORT_TYPE_SIMPLE,
        'datetime' => self::SORT_TYPE_SIMPLE,
    ];
}
