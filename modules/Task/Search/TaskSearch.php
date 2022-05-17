<?php

namespace Modules\Task\Search;

use App\Search\Search;

class TaskSearch extends Search
{
    protected array $relations = [
        'agent',
        'reports', 'reports.shop', 'reports.report',
        'reports.report.products', 'reports.report.products.product',
        'reports.report.products.variation', 'reports.report.products.supplier',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'agent_id' => Search::FILTER_TYPE_EQUAL,
        'type' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
        'deadline' => Search::FILTER_TYPE_EQUAL,
        'agent_status' => Search::FILTER_TYPE_EQUAL,
        'admin_status' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'agent_id' => Search::SORT_TYPE_SIMPLE,
        'type' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
        'deadline' => Search::SORT_TYPE_SIMPLE,
        'agent_status' => Search::SORT_TYPE_SIMPLE,
        'admin_status' => Search::SORT_TYPE_SIMPLE,
    ];
}
