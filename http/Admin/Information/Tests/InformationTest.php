<?php

namespace Http\Admin\Information\Tests;

class InformationTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_enums()
    {
        $this->requestUrl .= '/enums';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}