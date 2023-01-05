<?php

namespace Modules\Box\Search;

use App\Base\Search;
use App\Base\Search\Enums\SearchFilterTypeEnum;
use App\Base\Search\Enums\SearchSortTypeEnum;

class BrandSearch extends Search
{
    public array $relations = [
        'creator',
    ];

    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'creator_id' => SearchFilterTypeEnum::EQUAL_RAW,
        'name' => SearchFilterTypeEnum::LIKE,
        'show_on_the_home_page' => SearchFilterTypeEnum::EQUAL_RAW,
        'is_active' => SearchFilterTypeEnum::EQUAL_RAW,
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'name' => SearchSortTypeEnum::RAW,
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
