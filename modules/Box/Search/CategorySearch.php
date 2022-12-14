<?php

namespace Modules\Box\Search;

use App\Base\Search;

class CategorySearch extends Search
{
    public array $defaultSort = ['lft'];

    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'depth' => self::FILTER_CLASS_EQUAL_RAW,
        'name' => self::FILTER_CLASS_LOCALIZED_LIKE,
        
        'full_text' => [
            'condition' => self::FILTER_CONDITION_OR_WHERE,
            'filters' => [
                'name' => self::FILTER_CLASS_LOCALIZED_LIKE,
            ],
        ],
    ];

    public function with(array $params): static
    {
        parent::with($params);

        $this->query->with(['parents']);

        return $this;
    }

    public function filter(array $params): static
    {
        parent::filter($params);

        $this->query->where('depth', '>', 0);

        return $this;
    }

    public function show(array $params): static
    {
        parent::show($params);

        if (in_array('boxes_count', $params)) {
            $this->query
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
