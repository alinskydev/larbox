<?php

namespace Tests\Feature\Common\Information;

class SystemTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_settings()
    {
        $this->requestUrl .= '/system/settings';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_languages()
    {
        $this->requestUrl .= '/system/languages';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
