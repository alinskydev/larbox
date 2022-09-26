<?php

namespace Http\Admin\Feedback\Tests\Callback;

class SetValueTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_change_status()
    {
        $this->requestUrl .= '/1/set-status/in_process';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
