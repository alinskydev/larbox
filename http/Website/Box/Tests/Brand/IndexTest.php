<?php

namespace Http\Website\Box\Tests\Brand;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\Box\Search\BrandSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = BrandSearch::class;

    public function test_available_relations()
    {
        (new IndexFeatureTestService($this))->availableRelations();
    }

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'name' => 'brand',
                'show_on_the_home_page' => 1,
                'is_active' => 1,
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
