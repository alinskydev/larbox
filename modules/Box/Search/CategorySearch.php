<?php

namespace Modules\Box\Search;

use App\Base\Search;
use Illuminate\Database\Eloquent\Builder;

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

    public function with(array $params): static
    {
        parent::with($params);

        $this->queryBuilder->with(['parents']);

        return $this;
    }

    public function filter(array $params, string $combinedType, ?Builder $query = null): static
    {
        parent::filter($params, $combinedType, $query);

        $this->queryBuilder->where('depth', '>', 0);

        return $this;
    }

    public function show(array $params): static
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
