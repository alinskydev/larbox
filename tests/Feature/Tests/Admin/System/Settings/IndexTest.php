<?php

namespace Tests\Feature\Tests\Admin\System\Settings;

class IndexTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_success()
    {
        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
