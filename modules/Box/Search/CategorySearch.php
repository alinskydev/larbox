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

    /**
     * @param array $params
     * @return $this
     */
    public function show($params)
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
