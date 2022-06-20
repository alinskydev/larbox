<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\Traits\Index\AvailableSortingsTrait;
use App\Tests\Feature\Traits\Index\AvailableRelationsTrait;
use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;
use Modules\Box\Search\TagSearch;

class IndexTest extends _TestCase
{
    use AvailableSortingsTrait;
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $searchClass = TagSearch::class;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'name' => 'tag',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
