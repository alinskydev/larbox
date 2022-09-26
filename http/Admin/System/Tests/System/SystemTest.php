<?php

namespace Http\Admin\System\Tests\System;

class SystemTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_information()
    {
        $this->requestUrl .= '/information';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
