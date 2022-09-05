<?php

namespace Http\Admin\User\Tests\Notification;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\User\Search\NotificationSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = NotificationSearch::class;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'type' => 'message',
                'is_seen' => 0,
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
