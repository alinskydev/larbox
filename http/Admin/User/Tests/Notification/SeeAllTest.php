<?php

namespace Http\Admin\User\Tests\Notification;

class SeeAllTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/see-all';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
