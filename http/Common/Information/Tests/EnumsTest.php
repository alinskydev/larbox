<?php

namespace Http\Common\Information\Tests;

class EnumsTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_success()
    {
        $this->requestUrl .= '/enums';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
