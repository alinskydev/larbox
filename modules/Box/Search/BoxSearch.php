<?php

namespace Modules\Box\Search;

use App\Base\Search;
use Illuminate\Database\Eloquent\Builder;
use Modules\Box\Models\Category;

class BoxSearch extends Search
{
    public array $relations = [
        'brand', 'variations',
        'categories', 'tags',
    ];

    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'brand_id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LOCALIZED,
        'price' => self::FILTER_TYPE_BETWEEN,
        'date' => self::FILTER_TYPE_DATE,
        'datetime' => self::FILTER_TYPE_DATE,

        'tags.id' => self::FILTER_TYPE_IN,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
        'date' => self::SORT_TYPE_SIMPLE,
        'datetime' => self::SORT_TYPE_SIMPLE,
    ];

    public function filter(array $params, string $combinedType, ?Builder $query = null): self
    {
        parent::filter($params, $combinedType, $query);

        if (isset($params['categories.id']) && !is_iterable($params['categories.id'])) {
            // $categoriesIds = [$params['categories.id']];

            // $category = Category::query()->with(['children'])->where('id', $params['categories.id'])->first();

            // if ($category) {
            //     $children = HierarchyHelper::childrenAsList($category);
            //     $categoriesIds = array_merge($categoriesIds, data_get($children, '*.id'));
            // }

            // $this->queryBuilder->whereHas('categories', function ($q) use ($categoriesIds) {
            //     $q->whereIn('id', $categoriesIds);
            // });
        }

        return $this;
    }
}
