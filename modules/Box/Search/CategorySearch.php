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
        'name' => self::FILTER_TYPE_LOCALIZED_LIKE,
    ];

    public array $combinedFilters = [
        'full_text' => [
            'type' => self::COMBINED_FILTER_TYPE_ANY,
            'fields' => [
                'name' => self::FILTER_TYPE_LOCALIZED_LIKE,
            ],
        ],
    ];

    public function with(array $params): static
    {
        parent::with($params);

        $this->query->with(['parents']);

        return $this;
    }

    public function filter(array $params, string $combinedType, ?Builder $query = null): static
    {
        parent::filter($params, $combinedType, $query);

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
