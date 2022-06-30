<?php

namespace Modules\Box\Search;

use App\Search\Search;
use Illuminate\Support\Arr;

class BrandSearch extends Search
{
    public array $relations = [
        'creator',
    ];

    public array $filterable = [
        'id' => self::FILTER_TYPE_IN,
        'creator_id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LIKE,
        'show_on_the_home_page' => self::FILTER_TYPE_EQUAL,
        'is_active' => self::FILTER_TYPE_EQUAL,
    ];

    public array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
    ];

    public function show(array $params): self
    {
        parent::show($params);

        $params = Arr::flatten($params);

        if (in_array('boxes_count', $params)) {
            $this->queryBuilder->withCount('boxes');
        }

        return $this;
    }
}
