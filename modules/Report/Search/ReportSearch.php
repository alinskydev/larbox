<?php

namespace Modules\Report\Search;

use App\Search\Search;
use Illuminate\Support\Arr;

class ReportSearch extends Search
{
    protected array $relations = [
        'creator',
        'shop', 'shop.company', 'shop.city', 'shop.city.region',
        'task_report', 'task_report.task',
        'products', 'products.product', 'products.variation', 'products.supplier',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'creator_id' => Search::FILTER_TYPE_EQUAL,
        'shop_id' => Search::FILTER_TYPE_EQUAL,
        'task_report_id' => Search::FILTER_TYPE_EQUAL,
        'type' => Search::FILTER_TYPE_EQUAL,
        'number' => Search::FILTER_TYPE_EQUAL,
        'date_period_type' => Search::FILTER_TYPE_EQUAL,

        'shop.company_id' => Search::FILTER_TYPE_EQUAL,
        'shop.city_id' => Search::FILTER_TYPE_EQUAL,
        'shop.city.region_id' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'shop_id' => Search::SORT_TYPE_SIMPLE,
        'task_report_id' => Search::SORT_TYPE_SIMPLE,
        'type' => Search::SORT_TYPE_SIMPLE,
        'number' => Search::SORT_TYPE_SIMPLE,
        'date_period_from' => Search::SORT_TYPE_SIMPLE,
        'date_period_to' => Search::SORT_TYPE_SIMPLE,
    ];

    public function filter(array $params): self
    {
        parent::filter($params);

        if (isset($params['year'])) {
            $this->queryBuilder->where(function ($query) use ($params) {
                $query->whereYear('date_period_from', $params['year'])
                    ->orWhereYear('date_period_to', $params['year']);
            });
        }

        if (isset($params['date_period_min'])) {
            $this->queryBuilder->where(function ($query) use ($params) {
                $query->where('date_period_from', '>=', $params['date_period_min'])
                    ->orWhere('date_period_to', '>=', $params['date_period_min']);
            });
        }

        if (isset($params['date_period_max'])) {
            $this->queryBuilder->where(function ($query) use ($params) {
                $query->where('date_period_from', '<=', $params['date_period_max'])
                    ->orWhere('date_period_to', '<=', $params['date_period_max']);
            });
        }

        return $this;
    }
}
