<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\Traits\Index\AvailableSortingsTrait;
use App\Tests\Feature\Traits\Index\AvailableRelationsTrait;
use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;

use Modules\User\Search\UserSearch;

class IndexTest extends _TestCase
{
    use AvailableSortingsTrait;
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $searchClass = UserSearch::class;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'common' => 'admin',
                'id' => 1,
                'role' => 'admin',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
