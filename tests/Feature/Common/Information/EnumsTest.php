<?php

namespace Tests\Feature\Common\Information;

class EnumsTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_report()
    {
        $this->requestUrl .= '/enums/report';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_task()
    {
        $this->requestUrl .= '/enums/task';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_user()
    {
        $this->requestUrl .= '/enums/user';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
