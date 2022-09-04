<?php

namespace Http\Admin\Box\Tests\Box;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\Box\Search\BoxSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = BoxSearch::class;

    public function test_available_relations()
    {
        (new IndexFeatureTestService($this))->availableRelations();
    }

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'brand_id' => 1,
                'name' => 'box',
                'price' => [1000, 10000],
                'date' => date(LARBOX_FORMAT_DATE),
                'datetime' => date(LARBOX_FORMAT_DATETIME),
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
