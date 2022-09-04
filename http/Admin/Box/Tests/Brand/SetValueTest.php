<?php

namespace Http\Admin\Box\Tests\Brand;

class SetValueTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_deactivate()
    {
        $this->requestUrl .= '/1/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_activate()
    {
        $this->requestUrl .= '/1/set-active/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
