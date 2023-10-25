<?php

namespace Modules\Box\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterConditionEnum;
use App\Search\Enums\SearchFilterTypeEnum;

class CategorySearch extends Search
{
    public array $defaultSort = ['lft'];

    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'parent_id' => SearchFilterTypeEnum::EQUAL_RAW,
        'name' => SearchFilterTypeEnum::LOCALIZED_LIKE,

        'full_text' => [
            'condition' => SearchFilterConditionEnum::OR_WHERE,
            'filters' => [
                'name' => SearchFilterTypeEnum::LOCALIZED_LIKE,
            ],
        ],
    ];

    public function with(array $params): static
    {
        parent::with($params);

        $this->query->with(['ancestors']);

        return $this;
    }

    public function filter(array $params): static
    {
        parent::filter($params);

        $this->query->whereNotNull('parent_id');

        return $this;
    }

    public function show(array $params): static
    {
        parent::show($params);

        if (in_array('boxes_count', $params)) {
            $this->query
                ->with([
                    'descendants' => function ($query) {
                        $query->withCount('boxes');
                    },
                ])
                ->withCount('boxes');
        }

        return $this;
    }
}
