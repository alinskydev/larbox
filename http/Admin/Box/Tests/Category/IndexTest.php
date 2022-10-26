<?php

namespace Http\Admin\Box\Tests\Category;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\Box\Search\CategorySearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = CategorySearch::class;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 3,
                'parent_id' => 2,
                'depth' => 2,
                'name' => 'category',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
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
