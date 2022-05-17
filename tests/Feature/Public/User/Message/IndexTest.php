<?php

namespace Tests\Feature\Public\User\Message;

use App\Tests\Feature\Traits\Index\PaginationTrait;

class IndexTest extends _TestCase
{
    use PaginationTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
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
                'is_seen',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
