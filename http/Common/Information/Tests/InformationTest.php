<?php

namespace Http\Common\Information\Tests;

class InformationTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_system()
    {
        $this->requestUrl .= '/system';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_enums()
    {
        $this->requestUrl .= '/enums';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
