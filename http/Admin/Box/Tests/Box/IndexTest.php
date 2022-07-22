<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\Traits\Index\AvailableSortingsTrait;
use App\Tests\Feature\Traits\Index\AvailableRelationsTrait;
use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;

class IndexTest extends _TestCase
{
    use AvailableSortingsTrait;
    use AvailableRelationsTrait;
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'brand_id' => '1',
                'name' => 'box',
                'slug' => 'box-1',
                'price' => [1000, 10000],
                'date' => date(LARBOX_FORMAT_DATE),
                'datetime' => date(LARBOX_FORMAT_DATETIME),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
