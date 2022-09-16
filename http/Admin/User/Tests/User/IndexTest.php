<?php

namespace Http\Admin\User\Tests\User;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\User\Search\UserSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = UserSearch::class;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'common' => 'admin',
                'id' => 1,
                'role_id' => 1,
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        (new IndexFeatureTestService($this))->availableSortings();
    }

    public function test_show_with_deleted()
    {
        (new IndexFeatureTestService($this))->showWithDeleted();
    }

    public function test_show_only_deleted()
    {
        (new IndexFeatureTestService($this))->showOnlyDeleted();
    }

    public function test_pagination()
    {
        (new IndexFeatureTestService($this))->pagination();
    }
}
