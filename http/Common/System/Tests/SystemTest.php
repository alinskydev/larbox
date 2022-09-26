<?php

namespace Http\Common\System\Tests;

class SystemTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_information()
    {
        $this->requestUrl .= '/information';

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
