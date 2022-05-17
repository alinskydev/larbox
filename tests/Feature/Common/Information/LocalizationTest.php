<?php

namespace Tests\Feature\Common\Information;

class LocalizationTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_messages___Android()
    {
        $this->requestUrl .= '/localization/messages/android';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
