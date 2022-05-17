<?php

namespace Tests\Feature\Admin\User\Message;

use App\Tests\Feature\Traits\Index\PaginationTrait;

class IndexTest extends _TestCase
{
    use PaginationTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_relations()
    {
        $this->requestQuery = [
            'with' => [
                'user',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'user_id' => '2',
                'is_sent_by_admin' => '1',
                'is_seen' => '0',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        $this->requestQuery = [
            'sort' => [
                'id',
                'user_id',
                'is_seen',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
