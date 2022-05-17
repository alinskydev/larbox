<?php

namespace Tests\Feature\Admin\Region\City;

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
                'region',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => ['1', '2'],
                'region_id' => '1',
                'name' => 'city',
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
                'region_id',
                'name',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
