<?php

namespace Http\Website\Box\Tests\Category;

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
                'depth' => 2,
                'name' => 'category',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        (new IndexFeatureTestService($this))->availableSortings();
    }

    public function test_available_showings()
    {
        $this->requestQuery = [
            'show' => [
                'boxes_count',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_pagination()
    {
        (new IndexFeatureTestService($this))->pagination();
    }
}
