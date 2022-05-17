<?php

namespace Tests\Feature\Admin\Task\Task;

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
                'agent',
                'reports',
                'reports.shop',
                'reports.report',
                'reports.report.products',
                'reports.report.products.product',
                'reports.report.products.variation',
                'reports.report.products.supplier',
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
                'agent_id' => '2',
                'type' => 'v',
                'name' => 'task',
                'deadline' => date('d.m.Y', strtotime('+1 day')),
                'agent_status' => 'opened',
                'admin_status' => 'unchecked',
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
                'agent_id',
                'type',
                'name',
                'deadline',
                'agent_status',
                'admin_status',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
