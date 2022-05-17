<?php

namespace Tests\Feature\Admin\Report\Report;

use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;

class IndexTest extends _TestCase
{
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_relations()
    {
        $this->requestQuery = [
            'with' => [
                'creator',
                'shop',
                'shop.company',
                'shop.city',
                'shop.city.region',
                'task_report',
                'task_report.task',
                'products',
                'products.product',
                'products.variation',
                'products.supplier',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'creator_id' => '2',
                'shop_id' => '1',
                'task_report_id' => null,
                'type' => 'ds',
                'number' => 'Number 1',
                'date_period_type' => 'week',

                'shop.company_id' => '1',
                'shop.city_id' => '1',
                'shop.city.region_id' => '1',

                'year' => date('Y'),
                'date_period_min' => date('d.m.Y', strtotime('-1 month')),
                'date_period_max' => date('d.m.Y'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        $this->requestQuery = [
            'sort' => [
                'id',
                'creator_id',
                'shop_id',
                'task_report',
                'type',
                'number',
                'date_period_from',
                'date_period_to',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
