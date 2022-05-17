<?php

namespace Tests\Feature\Public\Product\Product;

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
                'category',
                'brand',
                'variations',
                'variations.options',
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
                'category_id' => '1',
                'brand_id' => '1',
                'model_number' => 'model',
                'sku' => 'sku 1',
                'date_eol' => date('d.m.Y'),
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
                'category_id',
                'brand_id',
                'model_number',
                'sku',
                'date_eol',
                'is_active',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
