<?php

namespace Modules\Box\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class TagSearch extends Search
{
    public array $filters = [
        'id' => SearchFilterTypeEnum::IN,
        'name' => SearchFilterTypeEnum::LIKE,
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'name' => SearchSortTypeEnum::RAW,
    ];
}
