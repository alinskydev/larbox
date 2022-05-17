<?php

namespace Tests\Feature\Public\Product\Brand;

use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;

class IndexTest extends _TestCase
{
    use PaginationTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_relations()
    {
        $this->requestQuery = [
            'with' => [
                'creator',
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
                'name' => 'brand',
                'is_active' => '1',
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
                'name',
                'is_active',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
