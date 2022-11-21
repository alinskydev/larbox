<?php

namespace Modules\Box\Search;

use App\Base\Search;

class CategorySearch extends Search
{
    public array $defaultSort = ['lft'];

    public array $filters = [
        'id' => self::FILTER_TYPE_EQUAL_RAW,
        'depth' => self::FILTER_TYPE_EQUAL_RAW,
        'name' => self::FILTER_TYPE_LOCALIZED,
    ];

    public array $combinedFilters = [
        'full_text' => [
            'type' => self::COMBINED_TYPE_OR,
            'fields' => [
                'name' => self::FILTER_TYPE_LOCALIZED,
            ],
        ],
    ];

    public array $sortings = [
        'lft' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
    ];

    public function show(array $params): self
    {
        parent::show($params);

        if (in_array('boxes_count', $params)) {
            $this->queryBuilder
                ->with([
                    'children' => function ($query) {
                        $query->withCount('boxes');
                    },
                ])
                ->withCount('boxes');
        }

        return $this;
    }
}
