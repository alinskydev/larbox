<?php

namespace Http\Admin\User\Tests\Role;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\User\Search\RoleSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = RoleSearch::class;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'name' => 'admin',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        (new IndexFeatureTestService($this))->availableSortings();
    }

    public function test_pagination()
    {
        (new IndexFeatureTestService($this))->pagination();
    }
}
