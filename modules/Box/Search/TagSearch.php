<?php

namespace Modules\Box\Search;

use App\Base\Search;

class TagSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'name' => self::FILTER_TYPE_LIKE,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
    ];
}
