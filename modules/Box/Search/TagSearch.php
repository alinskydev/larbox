<?php

namespace Modules\Box\Search;

use App\Base\Search;

class TagSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_IN,
        'name' => self::FILTER_CLASS_LIKE,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
        'name' => self::SORT_TYPE_RAW,
    ];
}
