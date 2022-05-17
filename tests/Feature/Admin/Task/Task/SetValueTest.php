<?php

namespace Tests\Feature\Admin\Task\Task;

class SetValueTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_set_admin_status()
    {
        $this->requestUrl .= '/1/set-admin_status/moderating';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
