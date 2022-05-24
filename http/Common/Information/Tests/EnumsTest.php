<?php

namespace Http\Common\Information\Tests;

class EnumsTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_user()
    {
        $this->requestUrl .= '/enums/user';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
