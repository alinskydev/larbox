<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\Traits\Index\AvailableSortingsTrait;
use App\Tests\Feature\Traits\Index\AvailableRelationsTrait;
use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;
use Modules\Box\Search\BoxSearch;

class IndexTest extends _TestCase
{
    use AvailableSortingsTrait;
    use AvailableRelationsTrait;
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $searchClass = BoxSearch::class;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'brand_id' => '1',
                'name' => 'box',
                'slug' => 'box-1',
                'date' => date('d.m.Y'),
                'datetime' => date('d.m.Y H:i:s'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
