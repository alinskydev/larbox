<?php

namespace Modules\Box\Search;

use App\Base\Search;

class BrandSearch extends Search
{
    public array $relations = [
        'creator',
    ];

    public array $filters = [
        'id' => self::FILTER_TYPE_EQUAL_RAW,
        'creator_id' => self::FILTER_TYPE_EQUAL_RAW,
        'name' => self::FILTER_TYPE_LIKE,
        'show_on_the_home_page' => self::FILTER_TYPE_EQUAL_RAW,
        'is_active' => self::FILTER_TYPE_EQUAL_RAW,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
    ];

    public function show(array $params): static
    {
        parent::show($params);

        if (in_array('boxes_count', $params)) {
            $this->query->withCount('boxes');
        }

        return $this;
    }
}
